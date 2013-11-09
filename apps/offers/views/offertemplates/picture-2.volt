<?php

/**
 * Video Template
 */

 ?>
{% if offer_data['warning_text'] is defined %}
	<div class="alert alert-danger"><p class='text-center'><strong>{{ offer_data['warning_text'] }}</strong></p></div>
{% endif %}

<section class='well'>
<h1>{{ offer_data['header'] }}</h1>
<p>{{ offer_data['main_text'] }}</p>
</section>

<div class="row">

<img class='col-xs-12 col-md-3' src="{{offer_data['image']}}" alt="Way of the Dodo" >
<p class='col-xs-12 col-md-9' >{{ offer_data['secondary_text'] }}</p>
<p class='col-xs-12 col-md-9' >{{ offer_data['secondary_text'] }}</p>
</div>



<form class="form-inline" role="form">
  <div class="form-group col-xs-6 col-md-4">
    <label class="sr-only" for="exampleInputEmail2">Email address</label>
    <input type="email" class="form-control" id="exampleInputEmail2" placeholder="Enter email">
  </div>
  <div class="form-group col-xs-6 col-md-4">
    <label class="sr-only" for="exampleInputPassword2">Full Name</label>
    <input type="text" class="form-control" id="exampleInputPassword2" placeholder="Full Name">
  </div>
  <div class="col-xs-12 col-md-4">
  	<button type="submit" class="btn btn-danger btn-large btn-block"><strong>Enter Now!</strong></button>
  </div>
</form>
