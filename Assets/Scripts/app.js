var JCCApp = JCCApp || {};

JCCApp.init = function() {
    this.initCreditItems();
    this.initCheckboxes();
    this.initRadios();
}

JCCApp.initCreditItems = function() {
    var creditItem = '.jcc-credit';
    var creditBox  = '.jcc-credit > input[type="radio"]';
    var updateText = '[data-update-text]';
    var updateVal  = '[data-update-val]';

    $(creditBox).change(function(event) {
        var target = event.target;

        $(creditItem).removeClass('active');

        $(target).parent(creditItem).addClass('active');
    });
}

JCCApp.initCheckboxes = function() {
    var checkbox = '.jcc-checkbox';

    $(checkbox + ' input[type="checkbox"]').change(function(event) {
        var target = event.target;
        $(target).parent(checkbox).toggleClass('checked');
    });
}

JCCApp.initRadios = function() {
    var radio = '.jcc-radio';

    $(radio + ' input[type="radio"]').change(function(event) {
        var target = event.target;
        var name = $(target).attr('name');

        if ( ! $(target).parent(radio).hasClass('checked')) {
            $(radio + ' [type="radio"][name="' + name + '"]').parent(radio).removeClass('checked');
            $(target).parent(radio).addClass('checked');
        }
    });
}

JCCApp.init();