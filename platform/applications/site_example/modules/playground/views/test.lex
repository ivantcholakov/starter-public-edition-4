Hello, {{name}}

<br />

{{ noparse }}
    Hello, {{ name }}!
{{ /noparse }}

<br />

{{ template:partial name="test1" /}}

<br />

{{ template:partial name="test2" }}
{{ /template:partial }}
