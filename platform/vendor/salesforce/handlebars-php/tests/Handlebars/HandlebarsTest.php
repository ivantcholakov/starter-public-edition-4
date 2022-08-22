<?php

/**
 * Class AutoloaderTest
 */
class HandlebarsTest extends PHPUnit\Framework\TestCase
{
    /**
     * Test handlebars autoloader
     *
     * @return void
     */
    public function testAutoLoad()
    {
        Handlebars\Autoloader::register(realpath(__DIR__ . '/../fixture/'));

        $this->assertTrue(class_exists('Handlebars\\Test'));
        $this->assertTrue(class_exists('Handlebars\\Example\\Test'));
    }

    /**
     * Test basic tags
     *
     * @param string $src    handlebars source
     * @param array  $data   data
     * @param string $result expected data
     *
     * @dataProvider simpleTagdataProvider
     *
     * @return void
     */
    public function testBasicTags($src, $data, $result)
    {
        $loader = new \Handlebars\Loader\StringLoader();
        $engine = new \Handlebars\Handlebars(array('loader' => $loader));
        $this->assertEquals($result, $engine->render($src, $data));
    }

    /**
     * Simple tag provider
     *
     * @return array
     */
    public function simpleTagdataProvider()
    {
        return array(
            array(
                '{{! This is comment}}',
                array(),
                ''
            ),
            array(
                '{{data}}',
                array('data' => 'result'),
                'result'
            ),
            array(
                '{{data.key}}',
                array('data' => array('key' => 'result')),
                'result'
            ),
        );
    }


    /**
     * Test helpers (internal helpers)
     *
     * @param string $src    handlebars source
     * @param array  $data   data
     * @param string $result expected data
     *
     * @dataProvider internalHelpersdataProvider
     *
     * @return void
     */
    public function testSimpleHelpers($src, $data, $result)
    {
        $loader = new \Handlebars\Loader\StringLoader();
        $helpers = new \Handlebars\Helpers();
        $engine = new \Handlebars\Handlebars(array('loader' => $loader, 'helpers' => $helpers));

        $this->assertEquals($result, $engine->render($src, $data));
    }

    /**
     * Simple helpers provider
     *
     * @return array
     */
    public function internalHelpersdataProvider()
    {
        return [
            [
                '{{#if data}}Yes{{/if}}',
                ['data' => true],
                'Yes'
            ],
            [
                '{{#if data}}Yes{{/if}}',
                ['data' => false],
                ''
            ],
            [
                '{{#unless data}}OK{{/unless}}',
                ['data' => false],
                'OK'
            ],
            [
                '{{#unless data}}OK {{else}}I believe{{/unless}}',
                ['data' => true],
                'I believe'
            ],
            [
                '{{#with data}}{{key}}{{/with}}',
                ['data' => ['key' => 'result']],
                'result'
            ],
            [
                '{{#each data}}{{this}}{{/each}}',
                ['data' => [1, 2, 3, 4]],
                '1234'
            ],
            [
                '{{#each data[0:2]}}{{this}}{{/each}}',
                ['data' => [1, 2, 3, 4]],
                '12'
            ],
            [
                '{{#each data[1:2]}}{{this}}{{/each}}',
                ['data' => [1, 2, 3, 4]],
                '23'
            ],
            [
                '{{#upper data}}',
                ['data' => "hello"],
                'HELLO'
            ],
            [
                '{{#lower data}}',
                ['data' => "HELlO"],
                'hello'
            ],
            [
                '{{#capitalize data}}',
                ['data' => "hello"],
                'Hello'
            ],
            [
                '{{#capitalize_words data}}',
                ['data' => "hello world"],
                'Hello World'
            ],
            [
                '{{#reverse data}}',
                ['data' => "hello"],
                'olleh'
            ],
            [
                "{{#inflect count 'album' 'albums' }}",
                ["count" => 1],
                'album'
            ],
            [
                "{{#inflect count 'album' 'albums' }}",
                ["count" => 10],
                'albums'
            ],
            [
                "{{#inflect count '%d album' '%d albums' }}",
                ["count" => 1],
                '1 album'
            ],
            [
                "{{#inflect count '%d album' '%d albums' }}",
                ["count" => 10],
                '10 albums'
            ],
            [
                "{{#default data 'OK' }}",
                ["data" => "hello"],
                'hello'
            ],
            [
                "{{#default data 'OK' }}",
                [],
                'OK'
            ],
            [
                "{{#truncate data 8 '...'}}",
                ["data" => "Hello World! How are you?"],
                'Hello Wo...'
            ],
            [
                "{{#raw}}I'm raw {{data}}{{/raw}}",
                ["data" => "raw to be included, but won't :)"],
                "I'm raw {{data}}"
            ],
            [
                "{{#repeat 3}}Yes {{/repeat}}",
                [],
                "Yes Yes Yes "
            ],
            [
                "{{#repeat 4}}Nice {{data}} {{/repeat}}",
                ["data" => "Daddy!"],
                "Nice Daddy! Nice Daddy! Nice Daddy! Nice Daddy! "
            ],
            [
                "{{#define test}}I'm Defined and Invoked{{/define}}{{#invoke test}}",
                [],
                "I'm Defined and Invoked"
            ],
        ];
    }

    /**
     * @param string $src
     * @param array $data
     * @param string $result
     * @param bool $enableDataVariables
     * @dataProvider internalDataVariablesDataProvider
     */
    public function testDataVariables($src, $data, $result, $enableDataVariables)
    {
        $loader = new \Handlebars\Loader\StringLoader();
        $helpers = new \Handlebars\Helpers();
        $engine = new \Handlebars\Handlebars(array(
            'loader' => $loader,
            'helpers' => $helpers,
            'enableDataVariables'=> $enableDataVariables,
        ));

        $this->assertEquals($result, $engine->render($src, $data));
    }

    public function testDataVariables1()
    {
        $object = new stdClass;
        $object->{'@first'} = 'apple';
        $object->{'@last'} = 'banana';
        $object->{'@index'} = 'carrot';
        $object->{'@unknown'} = 'zucchini';
        $data = ['data' => [$object]];
        $engine = new \Handlebars\Handlebars(array(
            'loader' => new \Handlebars\Loader\StringLoader(),
            'helpers' => new \Handlebars\Helpers(),
            'enableDataVariables'=> false,
        ));
        $template = "{{#each data}}{{@first}}, {{@last}}, {{@index}}, {{@unknown}}{{/each}}";

        $this->assertEquals('apple, banana, 0, zucchini', $engine->render($template, $data));
    }

    /**
     * Data provider for data variables
     * @return array
     */
    public function internalDataVariablesDataProvider()
    {
        // Build a standard set of objects to test against
        $keyPropertyName = '@key';
        $firstPropertyName = '@first';
        $lastPropertyName = '@last';
        $unknownPropertyName = '@unknown';
        $objects = [];
        foreach (['apple', 'banana', 'carrot', 'zucchini'] as $itemValue) {
            $object = new stdClass();
            $object->$keyPropertyName = $itemValue;
            $object->$firstPropertyName = $itemValue;
            $object->$lastPropertyName = $itemValue;
            $object->$unknownPropertyName = $itemValue;
            $objects[] = $object;
        }

        // Build a list of scenarios. These will be used later to build fanned out scenarios that will be used against
        // the test. Each entry represents two different tests: (1) when enableDataVariables is enabled and (2) not enabled.
        $scenarios = [
            [
                'src' => '{{#each data}}{{@index}}{{/each}}',
                'data' => ['data' => ['apple', 'banana', 'carrot', 'zucchini']],
                // @index should work the same regardless of the feature flag
                'outputNotEnabled' => '0123',
                'outputEnabled' => '0123',
            ],
            [
                'src' => '{{#each data}}{{@key}}{{/each}}',
                'data' => ['data' => ['apple', 'banana', 'carrot', 'zucchini']],
                'outputNotEnabled' => '',
                'outputEnabled' => '0123'
            ],
            [
                'src' => '{{#each data}}{{#each this}}outer: {{@../key}},inner: {{@key}};{{/each}}{{/each}}',
                'data' => ['data' => [['apple', 'banana'], ['carrot', 'zucchini']]],
                'outputNotEnabled' => 'outer: ,inner: ;outer: ,inner: ;outer: ,inner: ;outer: ,inner: ;',
                'outputEnabled' => 'outer: 0,inner: 0;outer: 0,inner: 1;outer: 1,inner: 0;outer: 1,inner: 1;',
            ],
            [
                'src' => '{{#each data}}{{#if @first}}true{{else}}false{{/if}}{{/each}}',
                'data' => ['data' => ['apple', 'banana', 'carrot', 'zucchini']],
                'outputNotEnabled' => 'falsefalsefalsefalse',
                'outputEnabled' => 'truefalsefalsefalse',
            ],
            [
                'src' => '{{#each data}}{{@first}}{{/each}}',
                'data' => ['data' => ['apple', 'banana', 'carrot', 'zucchini']],
                'outputNotEnabled' => '',
                'outputEnabled' => 'truefalsefalsefalse',
            ],
            [
                'src' => '{{#each data}}{{#each this}}outer: {{@../first}},inner: {{@first}};{{/each}}{{/each}}',
                'data' => ['data' => [['apple', 'banana'], ['carrot', 'zucchini']]],
                'outputNotEnabled' => 'outer: ,inner: ;outer: ,inner: ;outer: ,inner: ;outer: ,inner: ;',
                'outputEnabled' => 'outer: true,inner: true;outer: true,inner: false;outer: false,inner: true;outer: false,inner: false;',
            ],
            [
                'src' => '{{#each data}}{{#if @last}}true{{else}}false{{/if}}{{/each}}',
                'data' => ['data' => ['apple', 'banana', 'carrot', 'zucchini']],
                'outputNotEnabled' => 'falsefalsefalsefalse',
                'outputEnabled' => 'falsefalsefalsetrue'
            ],
            [
                'src' => '{{#each data}}{{@last}}{{/each}}',
                'data' => ['data' => ['apple', 'banana', 'carrot', 'zucchini']],
                'outputNotEnabled' => '',
                'outputEnabled' => 'falsefalsefalsetrue'
            ],
            [
                'src' => '{{#each data}}{{#each this}}outer: {{@../last}},inner: {{@last}};{{/each}}{{/each}}',
                'data' => ['data' => [['apple', 'banana'], ['carrot', 'zucchini']]],
                'outputNotEnabled' => 'outer: ,inner: ;outer: ,inner: ;outer: ,inner: ;outer: ,inner: ;',
                'outputEnabled' => 'outer: false,inner: false;outer: false,inner: true;outer: true,inner: false;outer: true,inner: true;'
            ],
            [
                // @index variables are ignored and the data variable is used
                'src' => '{{#each data}}{{@index}}{{/each}}',
                'data' => ['data' => [['@index' => 'apple'], ['@index' => 'banana'], ['@index' => 'carrot'], ['@index' => 'zucchini']]],
                'outputNotEnabled' => '0123',
                'outputEnabled' => '0123'
            ],
            [
                // @key variables are ignored and the data variable is used
                'src' => '{{#each data}}{{@index}}{{/each}}',
                'data' => ['data' => $objects],
                'outputNotEnabled' => '0123',
                'outputEnabled' => '0123'
            ],
            [
                // @first variables are used when data variables are not enabled.
                'src' => '{{#each data}}{{@first}}{{/each}}',
                'data' => ['data' => $objects],
                'outputNotEnabled' => 'applebananacarrotzucchini',
                'outputEnabled' => 'truefalsefalsefalse'
            ],
            [
                // @last variables are used when data variables are not enabled.
                'src' => '{{#each data}}{{@last}}{{/each}}',
                'data' => ['data' => $objects],
                'outputNotEnabled' => 'applebananacarrotzucchini',
                'outputEnabled' => 'falsefalsefalsetrue'
            ],
            [
                // @unknown variables are used when data variables are not enabled however since "unknown" is not a valid
                // value it should ignored.
                'src' => '{{#each data}}{{@unknown}}{{/each}}',
                'data' => ['data' => $objects],
                'outputNotEnabled' => 'applebananacarrotzucchini',
                'outputEnabled' => ''
            ],
        ];

        // Build out a test case for when the enableDataVariables feature is enabled and when it's not
        $fannedOutScenarios = [];
        foreach ($scenarios as $scenario) {
            $fannedOutScenarios['not enabled: ' . $scenario['src']] = [
                $scenario['src'],
                $scenario['data'],
                $scenario['outputNotEnabled'],
                false,
            ];
            $fannedOutScenarios['enabled: ' . $scenario['src']] = [
                $scenario['src'],
                $scenario['data'],
                $scenario['outputEnabled'],
                true,
            ];
        }
        return $fannedOutScenarios;
    }

    /**
     * Management helpers
     */
    public function testHelpersManagement()
    {
        $helpers = new \Handlebars\Helpers(array('test' => function () {
        }), false);
        $engine = new \Handlebars\Handlebars(array('helpers' => $helpers));
        $this->assertTrue(is_callable($engine->getHelper('test')));
        $this->assertTrue($engine->hasHelper('test'));
        $engine->removeHelper('test');
        $this->assertFalse($engine->hasHelper('test'));
    }

    /**
     * Custom helper test
     */
    public function testCustomHelper()
    {
        $loader = new \Handlebars\Loader\StringLoader();
        $engine = new \Handlebars\Handlebars(array('loader' => $loader));
        $engine->addHelper('test', function () {
            return 'Test helper is called';
        });
        $this->assertEquals('Test helper is called', $engine->render('{{#test}}', []));
    }

    /**
     * @param $dir
     *
     * @return bool
     */
    private function delTree($dir)
    {
        $contents = scandir($dir);
        if ($contents === false) {
            return;
        }
        $files = array_diff($contents, array('.', '..'));
        foreach ($files as $file) {
            (is_dir("$dir/$file")) ? delTree("$dir/$file") : unlink("$dir/$file");
        }

        return rmdir($dir);
    }

    /**
     * Its not a good test :) but ok
     */
    public function testCacheSystem()
    {
        $path = sys_get_temp_dir() . '/__cache__handlebars';

        @$this->delTree($path);

        $dummy = new \Handlebars\Cache\Disk($path);
        $engine = new \Handlebars\Handlebars(array('cache' => $dummy));
        $this->assertEquals(0, count(glob($path . '/*')));
        $engine->render('test', array());
        $this->assertEquals(1, count(glob($path . '/*')));
    }
}