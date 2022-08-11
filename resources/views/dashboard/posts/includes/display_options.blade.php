<script>
    var transition_time = 500;

    $(function () {
        $('#type').trigger('change');
        $('#image').trigger('blur');
        @if( $method == 'edit')
            $('#js-toggle_meta').trigger('click');
            $('#js-toggle_summary').trigger('click');
        @endif
    })

    // $('#test').on('click', function () {
    //     alert("Hello, you little bollocks!");
    // })

    $('#type').on('change', function () {
        var $this = $(this);
        if ($this.val() == 1) {
            show_temporal_options();
        } else if ($this.val() == 2) {
            show_categorized_options();
        } else {
            show_page_options();
        }
    })

    function show_temporal_options() {
        $('#category_id').fadeOut(0);
        $('#temporal_id').fadeIn(transition_time);
        $('#js-summary').slideDown(transition_time);
        $('#tags_row, #image_section, #sticky_row, #image_preview').removeClass('hidden').hide().slideDown(transition_time);
    }

    function show_categorized_options() {
        $('#temporal_id').fadeOut(0);
        $('#js-summary').fadeIn(transition_time);
        $('#category_id').fadeIn(transition_time);
        $('#image_section, #image_preview').removeClass('hidden').hide().slideDown(transition_time);
        $('#tags_row, #sticky_row').fadeOut(transition_time);
    }

    function show_page_options() {
        $('#temporal_id').fadeOut(transition_time);
        $('#category_id').fadeOut(transition_time);
        $('#js-summary').slideUp(transition_time);
        $('#tags_row, #image_section, #sticky_row, #image_preview').fadeOut(transition_time);
    }

    $("#js-toggle_summary, #js-toggle_meta").on('click', function () {
        var $this = $(this);
        var target = $this.attr('id') == 'js-toggle_meta' ? '#js-meta_slider' : '#js-summary_slider';
        var current_class = $this.attr('class');
        var toggle_class = current_class == "icon-circle-up" ? "icon-circle-down" : "icon-circle-up";
        var title_msg = $this.attr('title') == "Hide panel" ? "Show panel" : "Hide panel";

        $(target).slideToggle(transition_time, function () {
            $this.attr('class', toggle_class);
            $this.attr('title', title_msg);
        });
    })
</script>

