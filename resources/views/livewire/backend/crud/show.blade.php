<section class="col-lg-{{ $show_width }} mx-auto">
	@php
		$title ='Show '.$modul_name;
	@endphp
	<x-card :title="$title">
		<div class="row">
			<div class="col">
				<div class="table-responsive">
					<table class="table">
						<tbody>
							@foreach($row_show as $row)
							<tr>
								<th>{{ $row['label'] }}</th>
								{{-- get array multidimension --}}
		        				@php
		        					$field_nested = explode(".", $row['field']);
		        				@endphp

		        				@if(count($field_nested) == 1)
								<td>
									@if($row['format'])
										{!! $this->{$row['format']}($result_show[$row['field']]) !!}
									@else
										{{ $result_show[$row['field']] }}
									@endif
								</td>

								@else
								@php
		            			$val = $result_show;
		            			foreach ($field_nested as $key => $sub_field) {
		            				$val = $val[$sub_field];
		            			}	
		            			@endphp

								<td>
									@if($row['format'])
										{!! $this->{$row['format']}($val) !!}
									@else
										{{ $val }}
									@endif
								</td>
								@endif
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<div class="d-flex flex-row justify-content-between mt-3">
			<div>
				<button class="btn btn-sm bg-black" wire:click="lists()">
					<span>Close</span>
				</button>
			</div>
		</div>
	</x-card>
</section>