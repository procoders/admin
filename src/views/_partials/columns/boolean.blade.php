@if ($value === true)
    @if ($editable === true)
        <td data-search="1" class="editable-column editable editable-click {{$name}}-bool-field" data-type="address">
            <a href="javascript:;" class="editable-column editable editable-click" ><i class="fa fa-check" style="color: #2b542c;"></i></a>
        </td>
    @else
        <td>
            <i class="fa fa-check" style="color: #2b542c;"></i>
        </td>
    @endif
@else
    @if ($editable === true)
        <td data-search="0" class="editable-column editable editable-click {{$name}}-bool-field" data-type="address">
            <a href="javascript:;"><i class="fa fa-check" style="color: #2b542c;"></i></a>
        </td>
    @else
        <td data-search="0">
            <i class="fa fa-check" style="color: #2b542c;"></i>
        </td>
    @endif
@endif


@if ($value === true)
<script>

    $(document).ready(function() {

            var Address = function (options) {
                this.init('address', options, Address.defaults);
            };

            //inherit from Abstract input
            $.fn.editableutils.inherit(Address, $.fn.editabletypes.abstractinput);

            $.extend(Address.prototype, {
                /**
                 Renders input from tpl

                 @method render()
                 **/
                render: function() {
                    this.$input = this.$tpl.find('input');
                    console.log(this);
                },

                /**
                 Default method to show value in element. Can be overwritten by display option.

                 @method value2html(value, element)
                 **/
                value2html: function(value, element) {
                    if(!value) {
                        $(element).empty();
                        return;
                    }
                    var html = $('<div>').text(value.city).html() + ', ' + $('<div>').text(value.street).html() + ' st., bld. ' + $('<div>').text(value.building).html();
                    $(element).html(html);
                },

                /**
                 Gets value from element's html

                 @method html2value(html)
                 **/
                html2value: function(html) {
                    /*
                     you may write parsing method to get value by element's html
                     e.g. "Moscow, st. Lenina, bld. 15" => {city: "Moscow", street: "Lenina", building: "15"}
                     but for complex structures it's not recommended.
                     Better set value directly via javascript, e.g.
                     editable({
                     value: {
                     city: "Moscow",
                     street: "Lenina",
                     building: "15"
                     }
                     });
                     */
                    return null;
                },

                /**
                 Converts value to string.
                 It is used in internal comparing (not for sending to server).

                 @method value2str(value)
                 **/
                value2str: function(value) {
                    var str = '';
                    if(value) {
                        for(var k in value) {
                            str = str + k + ':' + value[k] + ';';
                        }
                    }
                    return str;
                },

                /*
                 Converts string to value. Used for reading value from 'data-value' attribute.

                @method str2value(str)
                 */
                str2value: function(str) {
                    /*
                     this is mainly for parsing value defined in data-value attribute.
                     If you will always set value by javascript, no need to overwrite it
                     */
                    return str;
                },

                /**
                 Sets value of input.

                 @method value2input(value)
                 @param {mixed} value
                 **/
                value2input: function(value) {
                    if(!value) {
                        return;
                    }
                    this.$input.filter('[name="city"]').val(value.city);
                    this.$input.filter('[name="street"]').val(value.street);
                    this.$input.filter('[name="building"]').val(value.building);
                },

                /**
                 Returns value of input.

                 @method input2value()
                 **/
                input2value: function() {
                    return {
                        city: this.$input.filter('[name="city"]').val(),
                        street: this.$input.filter('[name="street"]').val(),
                        building: this.$input.filter('[name="building"]').val()
                    };
                },

                /**
                 Activates input: sets focus on the first field.

                 @method activate()
                 **/
                activate: function() {
                    this.$input.filter('[name="city"]').focus();
                },

                /**
                 Attaches handler to submit form in case of 'showbuttons=false' mode

                 @method autosubmit()
                 **/
                autosubmit: function() {
                    this.$input.keydown(function (e) {
                        if (e.which === 13) {
                            $(this).closest('form').submit();
                        }
                    });
                }
            });

            Address.defaults = $.extend({}, $.fn.editabletypes.abstractinput.defaults, {
                tpl: '<div class="editable-address"><label><span>City: </span><input type="text" name="city" class="input-small"></label></div>'+
                '<div class="editable-address"><label><span>Street: </span><input type="text" name="street" class="input-small"></label></div>'+
                '<div class="editable-address"><label><span>Building: </span><input type="text" name="building" class="input-mini"></label></div>',

                inputclass: ''
            });
        $.fn.editabletypes.address = Address;

        //Address.init();




        $.fn.editable.defaults.mode = 'inline';
        $('.editable-column').editable();

        $('.{{$name}}-bool-field').editable({
            url: '/post',
            value: {
                city: "Moscow",
                street: "Lenina",
                building: "12"
            },
            validate: function(value) {
                if(value.city == '') return 'city is required!';
            },
            display: function(value) {
                if(!value) {
                    $(this).empty();
                    return;
                }
                var html = '<b>' + $('<div>').text(value.city).html() + '</b>, ' + $('<div>').text(value.street).html() + ' st., bld. ' + $('<div>').text(value.building).html();
                $(this).html(html);
            }
        });

    })

</script>
    <?php
    AssetManager::addScript('admin::js/bootstrap-editable.min.js');
    AssetManager::addStyle('admin::css/bootstrap-editable.css');
    ?>
@endif