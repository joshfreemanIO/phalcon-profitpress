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
            <?php
                if (isset($data['data-target'])) {
                    echo \ProfitPress\Components\Tag::button($data);
                } else {
                    echo \ProfitPress\Components\Tag::anchor($data);
                } ?>
    		</div>
		{% if loop.index is even or loop.last %}
    	</div>
    	{% endif %}
    {% endfor %}
</section>
{% endif %}

<?php if (!empty($modal) && $modal === true): ?>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Tier Level Too Low</h4>
      </div>
      <div class="modal-body">
        <p>Increase your Tier Level to access this functionality!</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <a href="increaseTierLevel" class='btn btn-danger'>Upgrade Account!</a>
      </div>
    </div>
  </div>
</div>
<?php endif ?>