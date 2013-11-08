<h1>Dashboard</h1>
{% if not (username is empty) %}
<p>Welcome: {{ username }}!</p>
{% endif %}

{% if links is defined %}
    <ul id="admin-navigation">
    {% for link, data in links %}
    	{% if data['noaccess'] is not false %}
        <li class="admin-button-container"><?php echo \ProfitPress\Components\Tag::anchor($data); ?></li>
        {% else %}
        <li class="admin-button-container admin-button-disabled"><?php echo \ProfitPress\Components\Tag::anchor($data); ?></li>
        {% endif %}
    {% endfor %}
    </ul>
{% endif %}