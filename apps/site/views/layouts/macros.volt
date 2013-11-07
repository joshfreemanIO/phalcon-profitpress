{%- macro listoflinks(links) %}
<ul>
{%- for link,attributes in related_links %}
<li><a href="{{ url(link.url) }}" title="{{ link.title|striptags }}">{{ link.text }}</a></li>
{%- endfor %}
</ul>
{%- endmacro %}

<?php
echo \Phalcon\Tag::linkTo(array($link,$data['name'],$data['attributes']));
 ?>