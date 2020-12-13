(function ($) {
  'use strict';

    $(document).ready(function() {
        var colorPickerMaterial = new ColorPicker.Material('#dc-ex1', {
            inline: true
        });

        var colorPickerMaterialCustomAnchor = new ColorPicker.Material('#dc-ex2', {
            color: '#e91e63'
        });

        var colorpickerInsideInputAnchor = $('#dc-ex3-anchor').find('[data-color]');
        var colorPickerMaterialInsideInput = new ColorPicker.Material('#dc-ex3', {
            color: '#9c27b0'
        });
        colorpickerInsideInputAnchor.css('background', colorPickerMaterialInsideInput.getColor());
        colorPickerMaterialInsideInput.on('change', function(color) {
            colorpickerInsideInputAnchor.css('background', color);
        });
        colorpickerInsideInputAnchor.on('click', function () {
            $('#dc-ex3').trigger('focus');

            return false;
        });

        var colorpickerInsideInputAnchorLeft = $('#dc-ex4-anchor').find('[data-color]');
        var colorPickerMaterialInsideInputLeft = new ColorPicker.Material('#dc-ex4', {
            color: '#673ab7'
        });
        colorpickerInsideInputAnchorLeft.css('background', colorPickerMaterialInsideInputLeft.getColor());
        colorPickerMaterialInsideInputLeft.on('change', function(color) {
            colorpickerInsideInputAnchorLeft.css('background', color);
        });

        var colorPickerMaterialInline = new ColorPicker.Material('#dc-ex5', {
            inline: true
        });

        var colorPickerMaterialCustomAnchorInline = new ColorPicker.Material('#dc-ex6', {
            color: '#3f51b5',
            inline: true
        });


        var colorpickerInsideInputAnchorInline = $('#dc-ex7-anchor').find('[data-color]');
        var colorPickerMaterialInsideInputInline = new ColorPicker.Material('#dc-ex7', {
            color: '#2196f3',
            inline: true
        });
        colorpickerInsideInputAnchorInline.css('background', colorPickerMaterialInsideInputInline.getColor());
        colorPickerMaterialInsideInputInline.on('change', function(color) {
            colorpickerInsideInputAnchorInline.css('background', color);
        });
        colorpickerInsideInputAnchorInline.on('click', function () {
            $('#dc-ex7').trigger('focus');

            return false;
        });

        var colorpickerInsideInputAnchorLeftInline = $('#dc-ex8-anchor').find('[data-color]');
        var colorPickerMaterialInsideInputLeftInline = new ColorPicker.Material('#dc-ex8', {
            color: '#009688',
            inline: true
        });
        colorpickerInsideInputAnchorLeftInline.css('background', colorPickerMaterialInsideInputLeftInline.getColor());
        colorPickerMaterialInsideInputLeftInline.on('change', function(color) {
            colorpickerInsideInputAnchorLeftInline.css('background', color);
        });

        var colorPickerMaterialHiddenAnchor = new ColorPicker.Material('#dc-ex9', {
            inline: true,
            anchor: {
                hidden: true
            }
        });

        var colorPickerMaterialHiddenArrow = new ColorPicker.Material('#dc-ex10', {
            arrow: false
        });

        var dynamicAnchorCssProperty = new ColorPicker.Material('#dc-ex11', {
            inline: true,
            color: '#8bc34a',
            anchor: {
                cssProperty: 'color'
            }
        });

        $('[name=dc-ex11-anchor-css-property]').on('change', function() {
            dynamicAnchorCssProperty.setAnchorCssProperty($(this).val());
        });

        $('.colorpicker-theme').on('change', function () {
            var val = $(this).val();
            var style = '<link id="colorpicker-style" rel="stylesheet" href="' + val + '">';
            $('head').append(style);
        });
    });
})(jQuery);
