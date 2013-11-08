{% if not (username is empty) %}
<p>Welcome: {{ username }}!</p>
{% endif %}

{% if links is defined %}
    <ul id="navigation">
    {% for link, data in links %}
    	{% if data['noaccess'] is not false %}
        <li><?php echo \ProfitPress\Components\Tag::anchor($data); ?></li>
        {% else %}
        <li><?php echo \ProfitPress\Components\Tag::anchor($data); ?></li>
        {% endif %}
    {% endfor %}
    </ul>
{% endif %}