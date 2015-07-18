<?php

Form::macro(
        'hasError',
        function ($errors, $name) {

            return $errors->has($name) ? 'has-error has-feedback' : '';
        }
);

Form::macro(
        'getError',
        function ($errors, $name) {

            if ($errors->has($name)) {
                return '<span class="glyphicon glyphicon-question-sign input-group-addon"
                            data-toggle="tooltip"
                            data-placement="right"
                            title=""
                            data-original-title="' . $errors->first($name) . '"></span>';
            }

            return '';

        }
);


Form::macro(
        'ckeditor',
        function ($name) {

            return '
            <script>
                CKEDITOR.replace("' . $name . '",
                    {
                    //filebrowserBrowseUrl: "/packages/ckfinder/ckfinder.html",
                    //filebrowserImageBrowseUrl: "/packages/ckfinder/ckfinder.html?type=Images",
                    //filebrowserUploadUrl: "/packages/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files",
                    //filebrowserImageUploadUrl: "/packages/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images"
                  }
                );
            </script>';
        }
);


Form::macro(
        'imageUploader',
        function ($model, $name, $width=  200, $hight = 200) {

            $return = '<div class="fileinput fileinput-new" data-provides="fileinput"><div class="fileinput-new thumbnail">';

            if ($model && $model->{$name}) {
                $return .= '<a target=_blank href="' . url($model->{$name}) . '">' .
                        Thumb::thumb($model->{$name}, $width, $hight ) . '</a>';
            } else {
                $return .= '<img src="http://www.placehold.it/200x200/EFEFEF/AAAAAA&text=no+image"/>';

            }

            $return .= Form::hidden($name, $model->{$name});
            $return .= '</div>';
            $return .= '<div class="fileinput-preview fileinput-exists thumbnail"></div>';
            $return .= '
                <div>
                <span class="btn btn-default btn-file">
                    <span class="fileinput-new"><i class="icon-uploadalt"></i></span>
                    <span class="fileinput-exists"><i class="icon-uploadalt"></i></span>
                    ' . Form::file($name.'_upload') . '
                </span>
                    <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">
                        <i class="icon-remove-sign"></i>
                    </a>
                </div>
            </div>
            ';

            return $return;
        }
);

Form::macro(
        'multiselect',
        function ($selector) {

            return '
                <script>
                        $(\''.$selector.'\').multiSelect({
                          selectableHeader: "<input type=\'text\' class=\'search-input form-control input-sm\' autocomplete=\'off\' placeholder=\'\'>",
                          selectionHeader: "<input type=\'text\' class=\'search-input form-control input-sm\' autocomplete=\'off\' placeholder=\'\'>",
                          afterInit: function(ms){
                            var that = this,
                                $selectableSearch = that.$selectableUl.prev(),
                                $selectionSearch = that.$selectionUl.prev(),
                                selectableSearchString = \'#\'+that.$container.attr(\'id\')+\' .ms-elem-selectable:not(.ms-selected)\',
                                selectionSearchString = \'#\'+that.$container.attr(\'id\')+\' .ms-elem-selection.ms-selected\';


                            $(\'#\'+that.$container.attr(\'id\')+\' li span\').each(function(){
                                $(this).html($(this).text());
                            });

                            that.qs1 = $selectableSearch.quicksearch(selectableSearchString)
                            .on(\'keydown\', function(e){
                              if (e.which === 40){
                                that.$selectableUl.focus();
                                return false;
                              }
                            });

                            that.qs2 = $selectionSearch.quicksearch(selectionSearchString)
                            .on(\'keydown\', function(e){
                              if (e.which == 40){
                                that.$selectionUl.focus();
                                return false;
                              }
                            });
                          },
                          afterSelect: function(){
                            this.qs1.cache();
                            this.qs2.cache();
                          },
                          afterDeselect: function(){
                            this.qs1.cache();
                            this.qs2.cache();
                          }
                        });
                    </script>
            ';

        }
);

Form::macro(
        'datePicker',
        function ($model, $name, $format = 'Y-m-d', $class = '', $settings = array()) {

            $settings = array_merge($settings, array('class' => 'form-control'));

            $return = '<div class="input-group input-append date '.$class.'" style="width: 205px">'.
                             Form::text($name, ( ($model->{$name}) ? $model->{$name}->format($format) : ''), $settings) .
                            '<div class="input-group-addon add-on">
                                <i class="icon-calendar"></i>
                            </div>
                        </div>';



            return $return;
        }
);