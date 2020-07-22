!function($, wysi) {
    "use strict";

    var templates = {
        
        "emphasis":    "<li>"+
                        "<div class='btn-group'>" +
                            "<a class='btn btn-default btn-equal' data-wysihtml5-command='bold' title='CTRL+B'><i class='fa fa-bold'></i></a>" +
                            "<a class='btn btn-default btn-equal' data-wysihtml5-command='italic' title='CTRL+I'><i class='fa fa-italic'></i></a>" +
                            "<a class='btn btn-default btn-equal' data-wysihtml5-command='underline' title='CTRL+U'><i class='fa fa-underline'></i></a>" +
                        "</div>"+
                        "</li>",
        "font-styles": "<li>"+
                        "<div class='btn-group'>" +
                               "<a class='btn btn-default' data-wysihtml5-command='formatBlock' data-wysihtml5-command-value='h1'><strong>H1</strong></a>" +
                               "<a class='btn btn-default' data-wysihtml5-command='formatBlock' data-wysihtml5-command-value='h2'><strong>H2</strong></a>" +
                       "</div>"+
                       "</li>",
        "lists":       "<li>" +
                           "<div class='btn-group'>" +
                               "<a class='btn btn-default btn-equal' data-wysihtml5-command='Outdent' title='Outdent'><i class='fa fa-align-right'></i></a>" +
                               "<a class='btn btn-default btn-equal' data-wysihtml5-command='Indent' title='Indent'><i class='fa fa-align-left'></i></a>" +
                           "</div>" +
                       "</li>" +
                        "<li>" +
                           "<div class='btn-group'>" +
                               "<a class='btn btn-default btn-equal' data-wysihtml5-command='insertUnorderedList' title='Unordered List'><i class='fa fa-list-ul'></i></a>" +
                               "<a class='btn btn-default btn-equal' data-wysihtml5-command='insertOrderedList' title='Ordered List'><i class='fa fa-list-ol'></i></a>" +
                            "</div>" +
                        "</li>",
        "link":        "<li>" +
                            "<div class='bootstrap-wysihtml5-insert-link-modal modal fade'>" +
                            '<div class="modal-dialog" role="document">'+
                            '<div class="modal-content">'+
                               "<div class='modal-header'>" +
                                   "<a class='close' data-dismiss='modal'>&times;</a>" +
                                   "<h3>Insert Link</h3>" +
                               "</div>" +
                               "<div class='modal-body'>" +
                                   "<input value='http://' class='bootstrap-wysihtml5-insert-link-url input-xlarge'>" +
                               "</div>" +
                               "<div class='modal-footer'>" +
                                   "<a href='#' class='btn' data-dismiss='modal'>Cancel</a>" +
                                   "<a href='#' class='btn btn-primary' data-dismiss='modal'>Insert link</a>" +
                               "</div>" +
                            '</div>'+
                            "</div>" +
                           "</div>" +
                           "<a class='btn btn-default btn-equal' data-wysihtml5-command='createLink' title='Link'><i class='fa fa-link'></i></a>" +
                       "</li>",
        "image":       "<li>" +
                           "<div class='bootstrap-wysihtml5-insert-image-modal modal fade'>" +
                           '<div class="modal-dialog" role="document">'+
                            '<div class="modal-content">'+
                                "<div class='modal-header'>" +
                                    "<a class='close' data-dismiss='modal'>&times;</a>" +
                                    "<h3>Insert Image</h3>" +
                                "</div>" +
                                "<div class='modal-body'>" +
                                    "<input value='http://' class='bootstrap-wysihtml5-insert-image-url input-xlarge'>" +
                                "</div>" +
                                "<div class='modal-footer'>" +
                                    "<a href='#' class='btn' data-dismiss='modal'>Cancel</a>" +
                                    "<a href='#' class='btn btn-primary' data-dismiss='modal'>Insert image</a>" +
                                "</div>" +
                            '</div>'+
                            "</div>" +
                           "</div>" +
                           "<a class='btn btn-default btn-equal' data-wysihtml5-command='insertImage' title='Insert image'><i class='fa fa-picture-o'></i></a>" +
                       "</li>",
        "html":
                       "<li>" +
                           "<div class='btn-group'>" +
                               "<a class='btn btn-default btn-equal' data-wysihtml5-action='change_view' title='Edit HTML'><i class='fa fa-code'></i></a>" +
                           "</div>" +
                       "</li>"
    };
    
    var defaultOptions = {
        "emphasis": true,
        "font-styles": true,
        "lists": true,
        "link": true,
        "image": true,
        "html": true,
        events: {},
        parserRules: {
            tags: {
                "b":  {},
                "i":  {},
                "br": {},
                "ol": {},
                "ul": {},
                "li": {},
                "h1": {},
                "h2": {},
                "u": 1,
                "img": {
                    "check_attributes": {
                        "width": "numbers",
                        "alt": "alt",
                        "src": "url",
                        "height": "numbers"
                    }
                },
                "a":  {
                    set_attributes: {
                        target: "_blank",
                        rel:    "nofollow"
                    },
                    check_attributes: {
                        href:   "url" // important to avoid XSS
                    }
                }
            }
        },
        stylesheets: []
};
    
    var Wysihtml5 = function(el, options) {
        this.el = el;
        this.toolbar = this.createToolbar(el, options || defaultOptions);
        this.editor =  this.createEditor(options);

        window.editor = this.editor;

        $('iframe.wysihtml5-sandbox').each(function(i, el){
            $(el.contentWindow).off('focus.wysihtml5').on({
              'focus.wysihtml5' : function(){
                 $('li.dropdown').removeClass('open');
               }
            });
        });
    };

    Wysihtml5.prototype = {

        constructor: Wysihtml5,

        createEditor: function(options) {
            options = $.extend(defaultOptions, options || {});
		    options.toolbar = this.toolbar[0];

		    var editor = new wysi.Editor(this.el[0], options);

            if(options && options.events) {
                for(var eventName in options.events) {
                    editor.on(eventName, options.events[eventName]);
                }
            }

            return editor;
        },

        createToolbar: function(el, options) {
            var self = this;
            var toolbar = $("<ul/>", {
                'class' : "wysihtml5-toolbar",
                'style': "display:none"
            });

            for(var key in defaultOptions) {
                var value = false;

                if(options[key] !== undefined) {
                    if(options[key] === true) {
                        value = true;
                    }
                } else {
                    value = defaultOptions[key];
                }

                if(value === true) {
                    toolbar.append(templates[key]);

                    if(key == "html") {
                        this.initHtml(toolbar);
                    }

                    if(key == "link") {
                        this.initInsertLink(toolbar);
                    }

                    if(key == "image") {
                        this.initInsertImage(toolbar);
                    }
                }
            }

            toolbar.find("a[data-wysihtml5-command='formatBlock']").click(function(e) {
                var el = $(e.srcElement);
                self.toolbar.find('.current-font').text(el.html());
            });

            this.el.before(toolbar);

            return toolbar;
        },

        initHtml: function(toolbar) {
            var changeViewSelector = "a[data-wysihtml5-action='change_view']";
            toolbar.find(changeViewSelector).click(function(e) {
                toolbar.find('a.btn').not(changeViewSelector).toggleClass('disabled');
            });
        },

        initInsertImage: function(toolbar) {
            var self = this;
            var insertImageModal = toolbar.find('.bootstrap-wysihtml5-insert-image-modal');
            var urlInput = insertImageModal.find('.bootstrap-wysihtml5-insert-image-url');
            var insertButton = insertImageModal.find('a.btn-primary');
            var initialValue = urlInput.val();
            var caretBookmark;

            var insertImage = function() {
                var url = urlInput.val();
                urlInput.val(initialValue);
                self.editor.currentView.element.focus();
                if (caretBookmark) {
                  self.editor.composer.selection.setBookmark(caretBookmark);
                  caretBookmark = null;
                }
                self.editor.composer.commands.exec("insertImage", url);
            };

            urlInput.keypress(function(e) {
                if(e.which == 13) {
                    insertImage();
                    insertImageModal.modal('hide');
                }
            });

            insertButton.click(insertImage);

            insertImageModal.on('shown', function() {
                urlInput.focus();
            });

            insertImageModal.on('hide', function() {
                self.editor.currentView.element.focus();
            });

            toolbar.find('a[data-wysihtml5-command=insertImage]').click(function() {
                var activeButton = $(this).hasClass("wysihtml5-command-active");

                if (!activeButton) {
                    self.editor.currentView.element.focus({});
                    caretBookmark = self.editor.composer.selection.getBookmark();
                    insertImageModal.appendTo('body').modal('show');
                    insertImageModal.on('click.dismiss.modal', '[data-dismiss="modal"]', function(e) {
                        e.stopPropagation();
                    });
                    return false;
                }
                else {
                    return true;
                }
            });
        },

        initInsertLink: function(toolbar) {
            var self = this;
            var insertLinkModal = toolbar.find('.bootstrap-wysihtml5-insert-link-modal');
            var urlInput = insertLinkModal.find('.bootstrap-wysihtml5-insert-link-url');
            var insertButton = insertLinkModal.find('a.btn-primary');
            var initialValue = urlInput.val();

            var insertLink = function() {
                var url = urlInput.val();
                urlInput.val(initialValue);
                self.editor.composer.commands.exec("createLink", {
                    href: url,
                    target: "_blank",
                    rel: "nofollow"
                });
            };
            var pressedEnter = false;

            urlInput.keypress(function(e) {
                if(e.which == 13) {
                    insertLink();
                    insertLinkModal.modal('hide');
                }
            });

            insertButton.click(insertLink);

            insertLinkModal.on('shown', function() {
                urlInput.focus();
            });

            insertLinkModal.on('hide', function() {
                self.editor.currentView.element.focus();
            });

            toolbar.find('a[data-wysihtml5-command=createLink]').click(function() {
                insertLinkModal.modal('show');
                insertLinkModal.on('click.dismiss.modal', '[data-dismiss="modal"]', function(e) {
					e.stopPropagation();
				});
                return false;
            });


        }
    };

    $.fn.wysihtml5 = function (options) {
        return this.each(function () {
            var $this = $(this);
            $this.data('wysihtml5', new Wysihtml5($this, options));
        });
    };

    $.fn.wysihtml5.Constructor = Wysihtml5;

}(window.jQuery, window.wysihtml5);