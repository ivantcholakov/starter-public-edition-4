# TSCompiler

## Aim of this project

The aim of this project is to provide interfaces to the TypeScript compiler in multiple languages.

You can easily compile TypeScript code on-the-fly with this package.

## Currently implemented languages

### JavaScript / TypeScript

#### Embedding in TypeScript

This interface is itself completely written in TypeScript. Therefore you can also reference the `*.ts` source file in your existing TypeScript project.

Just include this line on top of your file:

`///<reference path="../src/main.ts" />`
<br />

#### Embedding in HTML

Include this single file:
<br /><br />
`<script type="text/javascript" src="js/build/TSCompiler.min.js"></script>`
<br /><br />

You then can call these functions:

- `TSCompiler.compileStr()` and `TSCompiler.runStr()`
- `TSCompiler.runScriptBlock()` and `TSCompiler.runAllScriptBlocks()`
- `TSCompiler.compileExtern()`

See the provided samples: <http://comfreek.github.com/TSCompiler/demo/>

### PHP

This module accesses the TypeScript compiler on the command line (`tsc`). <br />
So you have to install TypeScript before using this interface. But that should be very easy if you already have [NodeJS](http://nodejs.org/) (<i>Don't have it yet? Get it!</i>) installed:

`npm install -g typescript`

`TSCompiler.class.php` defines a static class with two functions (besides two static variables):

- `TSCompiler::compile()`
- `TSCompiler::compileToStr()`

Because the code uses the command line interface, we have to declare an input and output filename.
So a temporary file is always created.

You cannot compile a raw string at the current moment but that should not be too difficult to implement.


## About

Developed by [@ComFreek](http://twitter.com/comfreek)!
<br />Checkout my other projects here: [http://github.com/ComFreek](http://github.com/ComFreek)

The original idea of a JavaScript interface came from here: [https://github.com/niutech/typescript-compile](https://github.com/niutech/typescript-compile).
<br />
I have completely rewritten all the code and its the internal structure from scratch.



## License

This is project is licensed under the same license agreement as TypeScript from Microsoft:

Apache License 2.0: <http://www.apache.org/licenses/LICENSE-2.0>