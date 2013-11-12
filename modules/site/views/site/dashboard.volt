<h1>Dashboard</h1>
{% if not (username is empty) %}
<p>Welcome: {{ username }}!</p>
{% endif %}

{% if links is defined %}
<section class="row container">
    {% for link, data in links %}
    	{% if loop.index is odd or loop.first %}
    	<div class="row">
    	{% endif %}
    		<div class="col-sm-6 bottom-buffer">
	        <?php echo \ProfitPress\Components\Tag::anchor($data); ?></li>
    		</div>
		{% if loop.index is even or loop.last %}
    	</div>
    	{% endif %}
    {% endfor %}
</section>
{% endif %}