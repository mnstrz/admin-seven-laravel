<div class="form-group form-row">
    {{ Form::label($label, null, ['class' => 'control-label col-lg-'.$column[0]]) }}
	<div class="col-lg-{{ $column[1] }}">
	    {{ Form::text(
	    	$name, 
	    	$value, 
	    	array_merge(
	    		$attributes, 
	    		$events,
	    		[
	    			'class' => 'form-control',
	    			'id' => $id,
	    			'placeholder' => $placeholder
	    		]
	    		)
	    	) 
	    }}
	</div>
	@if(!empty($info))
    	<small class="form-text text-muted">{{ $info }}</small>
	@endif
</div>