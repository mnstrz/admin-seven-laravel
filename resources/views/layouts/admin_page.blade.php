<!DOCTYPE html>
<html>
<head>
	<title>{{ (isset($title)) ? $title.' - ' : '' }} {{ config('app.name') }}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @if(isset($plugins,$css))
      <x-css :plugins="$plugins" :css="$css" />
    @elseif(isset($plugins))
      <x-css :plugins="$plugins" />
    @elseif(isset($css))
      <x-css :css="$css" />
    @else
      <x-css />
    @endif

    @livewireStyles
    @stack('css')
</head>
<body class="hold-transition {{ (empty(AdminSeven::theme("is_top_nav"))) ? 'sidebar-mini' : 'sidebar-collapse' }} layout-fixed {{ config('adminSeven.accent.'.AdminSeven::accentSkin()) }} {{ AdminSeven::theme("is_body_small") }} {{ AdminSeven::theme("is_sidebar_default_collapse") }} {{ AdminSeven::theme("is_fixed_navbar") }} {{ AdminSeven::theme("is_fixed_footer") }} {{ AdminSeven::theme("is_boxed") }} {{ AdminSeven::theme("is_sidebar_fixed") }} {{ AdminSeven::theme("is_top_nav") }}">
  <div class="wrapper">
    
    <x-navbar />

    <div class="content-wrapper">

      <div class="content-header">
        <div class="{{ (empty(AdminSeven::theme("is_top_nav"))) ? 'container-fluid' : 'container' }}">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">{{ (isset($title)) ? $title : '' }}</h1>
            </div>
            @if(isset($breadcrumb))
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('/backend') }}">Dashboard</a></li>
                @foreach($breadcrumb as $name => $link)
                  <li class="breadcrumb-item">
                    <a href="{{ $link }}">{{ $name }}</a>
                  </li>
                @endforeach
              </ol>
            </div>
            @endif
          </div>
        </div>
      </div>

      <section class="content">
        <div class="{{ (empty(AdminSeven::theme("is_top_nav"))) ? 'container-fluid' : 'container' }}">
          @yield('content')
        </div>
      </section>

    </div>

    <x-footer />

  </div>
  
    @if(isset($plugins,$js))
      <x-js :plugins="$plugins" :js="$js" />
    @elseif(isset($plugins))
      <x-js :plugins="$plugins" />
    @elseif(isset($js))
      <x-js :js="$js" />
    @else
      <x-js />
    @endif

  @livewireScripts
	@stack('js')
</body>
</html>
