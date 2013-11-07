{% set links = [
'asdf1': ['noaccess': 'true', 'text': 'ASDF1', 'title': 'ASDF' ],
'asdf2': ['noaccess': 'true', 'text': 'ASDF2', 'title': 'ASDF2','uri': 'uri'],
'asdf3': ['noaccess': 'false', 'text': 'ASDF3', 'title': 'ASDF3','uri': 'uri']

] %}


{% if links is defined %}
    <ul id="navigation">
    {% for link, data in links %}
        <li>{% if data['noaccess'] is not false %}
        <?php echo \ProfitPress\Components\Tag::anchor($data); ?>
        {% else %}
        <?php echo \ProfitPress\Components\Tag::anchor($data); ?>
        {% endif %}
        </li>
    {% endfor %}
    </ul>
{% endif %}
{{link_to('asdf','asdf')}}