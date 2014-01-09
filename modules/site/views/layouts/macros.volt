{%- macro listoflinks(links) %}
<ul>
{%- for link,attributes in related_links %}
<li><a href="{{ url(link.url) }}" title="{{ link.title|striptags }}">{{ link.text }}</a></li>
{%- endfor %}
</ul>
{%- endmacro %}


{%- macro admin(array) %}
<?php foreach ($array as $button => $description): ?>

<?php endforeach ?>
<div>
    <span class="error-type">{{ type }}</span>
    <span class="error-field">{{ field }}</span>
    <span class="error-message">{{ message }}</span>
</div>
{%- endmacro %}