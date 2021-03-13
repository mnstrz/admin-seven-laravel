<div class="tree-menu">
	{!! $render_menu !!}
</div>
@push('js')
<script type="text/javascript">

	var simplemde = new SimpleMDE(
				      { 
				    	element: $("#markdown")[0],
				    	toolbar : false,
				    	toolbarTips : false,
				    	renderingConfig: {
							singleLineBreaks: true,
							codeSyntaxHighlighting: true,
						},
						status : false,
				  	   }
				    )
	var current, next, prev

    $(document).ready(function(e){
    	getContent(1)
    })

	$(document).on('click','.menu',function(e){
		let parent = $(this).data('parent')
		let id = $(this).data('id')
		if(parent){
			$('#menu_'+parent).toggleClass('show')
		}
		getContent(id)
	})

	$(document).on('click','#link_next',function(e){
		getContent(next)
	})

	$(document).on('click','#link_prev',function(e){
		getContent(prev)
	})

	function getContent(id)
	{
		$.ajax({
			url : "{{ route('documentation') }}",
			method : "POST",
			data : {
				_token : '{{ csrf_token() }}',
				id : id
			},
			beforeSend : function(e){

			},
			error : function(e){

			},
			success : function(xhr){
				if(xhr.content){
					simplemde.toTextArea();
					simplemde = null;
					simplemde = new SimpleMDE(
			        { 
				    	element: $("#markdown")[0],
				    	toolbar : false,
				    	toolbarTips : false,
				    	renderingConfig: {
							singleLineBreaks: true,
							codeSyntaxHighlighting: true,
						},
						status : false
			  	    })
					simplemde.value(atob(xhr.content))
					simplemde.togglePreview()
					if(xhr.prev){
						$("#prev_doc").show()
						$('#link_prev').removeAttr('data-id')
						$('#prev_doc small').text(xhr.prev_page)
						prev = xhr.prev
					}else{
						$("#prev_doc").hide()
					}
					if(xhr.next){
						$("#next_doc").show()
						$('#link_next').removeAttr('data-id')
						$('#next_doc small').text(xhr.next_page)
						next = xhr.next
					}else{
						$("#next_doc").hide()
					}
				}
			}
		})
	}
</script>
@endpush