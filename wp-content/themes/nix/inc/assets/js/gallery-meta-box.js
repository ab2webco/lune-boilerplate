/**
 * File: kfp-gallery/js/gallery-meta-box.js
 *
 * https://github.com/ericandrewlewis/wp-media-javascript-guide
 */

jQuery(document).ready(function($) {
    var meta_gallery_frame;
    $('#boton_crear_gallery').click(function(e) {
        e.preventDefault();
        // Si el frame existe abre la modal.
        if (meta_gallery_frame) {
            meta_gallery_frame.open();
            return;
        }

        // Si no hay valores crea una galería de cero, si los hay edita la actual.
        var ids_gallery = $('#ids_gallery').val();
        if (!(ids_gallery)) {
            // Crea un nuevo frame de tipo galería
            meta_gallery_frame = wp.media.frames.wp_media_frame = wp.media({
                title: 'Galería de fotos',
                frame: "post",
                state: 'gallery-library',
                library: {
                    type: 'image'
                },
                multiple: true
            });
            // Abre la modal con el frame
            meta_gallery_frame.open();
        } else {
            // Abre la modal con el frame y con los attachment de la galería cargados
            meta_gallery_frame = wp.media.gallery.edit("[gallery ids='" + ids_gallery + "']");
        }
        // Cuando se actualice la galería, pulsando el botón correspondiente de la modal,
        // actualiza las miniaturas y los valores que se guardarán en el input oculto.
        meta_gallery_frame.on("update", function(selection) {
            var $vista_previa = $('#mb-vista-previa-gallery')
            $vista_previa.html('');
            // La función map itera sobre selection.models, crea el código html y devuelve los ids.
            var count = 0;
            var ids = selection.models.map(
                function(e) {
                    elemento = e.toJSON();
                    imagen_url = typeof elemento.sizes.full !== 'undefined' ? elemento.sizes.full.url : elemento.url;
                    html = "<div class='mb-miniatura-gallery'style='background: url(" + imagen_url + ") center / cover'></div><input id='extra_fields[galleries][" + count + "]' name='extra_fields[galleries][" + count + "]' type='hidden' value='" + imagen_url + "' width='30'>";
                    $vista_previa.append(html);
                    count++;
                    return e.id;
                }

            );
            console.log(ids);
            $('#ids_gallery').val(ids.join(',')).trigger('change');
        });
    });

    $('#boton_eliminar_gallery').click(function(e) {
        e.preventDefault();
        // Elimina los ids del input.
        $('#ids_gallery').val('').trigger('change');
        // Elimina las miniaturas.
        $('#mb-vista-previa-gallery').html("<input id='extra_fields[galleries]' name='extra_fields[galleries]' type='hidden' value='' width='30'>");
        imagen_url = typeof elemento.sizes.full !== 'undefined' ? elemento.sizes.full.url : elemento.url;
        $('input').val = '';
        return;
    });

    // Set all variables to be used in scope
    var frame,
        metaBox = $('#nix_banners_location.postbox'), // Your meta box id here
        addImgLink = metaBox.find('.upload-custom-img'),
        delImgLink = metaBox.find('.delete-custom-img'),
        imgContainer = metaBox.find('.custom-img-container'),
        imgIdInput = metaBox.find('.custom-img-id');

    // ADD IMAGE LINK
    addImgLink.on('click', function(event) {
        event.preventDefault();

        // If the media frame already exists, reopen it.
        if (frame) {
            frame.open();
            return;
        }

        // Create a new media frame
        frame = wp.media({
            title: 'Select or Upload Media Of Your Chosen Persuasion',
            button: {
                text: 'Use this media'
            },
            multiple: false // Set to true to allow multiple files to be selected
        });


        // When an image is selected in the media frame...
        frame.on('select', function() {

            // Get media attachment details from the frame state
            var attachment = frame.state().get('selection').first().toJSON();

            // Send the attachment URL to our custom image input field.
            imgContainer.append('<img src="' + attachment.url + '" class="mb-miniatura-gallery" width="150" alt="" "/>');
            imgContainer.append('<input id="" name="extra_fields[gallery][0]" type="hidden" value="' + attachment.url + '" width="30">');
            // Send the attachment id to our hidden input
            imgIdInput.val(attachment.id);

            // Hide the add image link
            addImgLink.addClass('hidden');

            // Unhide the remove image link
            delImgLink.removeClass('hidden');
        });

        // Finally, open the modal on click
        frame.open();
    });


    // DELETE IMAGE LINK

    delImgLink.on('click', function(event) {

        event.preventDefault();

        // Clear out the preview image
        imgContainer.html('');

        // Un-hide the add image link
        addImgLink.removeClass('hidden');

        // Hide the delete image link
        delImgLink.addClass('hidden');

        // Delete the image id from the hidden input
        imgIdInput.val('');

    });

});