/*************************************************************************/
/* Widget Back-end Form Scripts */
/*************************************************************************/

(function ($) {
  $(document).on('widget-updated widget-added ready', function (e, widget) {
    var $widgets = $('.nazarkinre-wpiw-form-wrapper')

    if (e.type === 'widget-updated' || e.type === 'widget-added') {
      $widgets = $(widget)
    }

    $widgets.find('.image-repeatable-fields-list').each(function () {
      var $this = $(this),
        $field_template = $this.find('.image-repeatable-fields-list__template').clone(),
        $fields_list = $this.find('.image-repeatable-fields-list__list')

      // make fields sortable
      Sortable.create($fields_list.get(0), {
        handle:    '.image-repeatable-field__drag-handle',
        animation: 150
      })

      // prevent any actions from clicks inside repeatable field
      $this.on('click', '.image-repeatable-field__controls a', function (e) {
        e.preventDefault()
      })

      // create new field copy on click
      $('.image-repeatable-fields-list__add', $this).on('click', function (e) {
        e.preventDefault()
        $field_template.clone().removeClass('image-repeatable-fields-list__template').appendTo($fields_list)
      })

      // open image selector
      $this.on('click', '.image-repeatable-field__image', function () {
        var $this = $(this), frame = $this.data('wp-media-frame')

        if (frame) {
          frame.open()
          return
        }

        frame = wp.media({ title: 'Select image', multiple: false })

        // when an image is selected in the media frame...
        frame.on('select', function () {
          var attachment = frame.state().get('selection').first().toJSON()
          $this.find('.image-repeatable-field__image-hidden-field').val(attachment.id).trigger('input');
          $this.find('img').remove()
          $this.append($('<img/>', { src: attachment.sizes.thumbnail.url }))
        })

        $this.data('wp-media-frame', frame)
        frame.open()
      })

      // remove field group
      $this.on('click', '.image-repeatable-field__remove', function () {
        confirm('Are you sure?') && $(this).closest('.image-repeatable-field').remove()
      })
    })
  })
})(jQuery)
