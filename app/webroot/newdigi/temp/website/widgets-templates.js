/* Source: temp/website/widgets-templates.js*/
angular.module("website.widgets.templates", ["@websiteWidgets/form_elements/moto_form_errors.ng.html", "@websiteWidgets/pagination/template.ng.html"]);

angular.module("@websiteWidgets/form_elements/moto_form_errors.ng.html", []).run(["$templateCache", function($templateCache) {
    $templateCache.put("@websiteWidgets/form_elements/moto_form_errors.ng.html",
        "<div class=\"moto-form__errors-items\" data-ng-cloak ng-if=\"($FORM.$submitted || $FORM[fieldName].$touched) && $FORM[fieldName].$invalid\">\n" +
        "    <div class=\"moto-form__error-item moto-form__error-item_required\" ng-if=\"$FORM[fieldName].$error.required\">{{ ::messages.required }}</div>\n" +
        "    <div class=\"moto-form__error-item moto-form__error-item_minlength\" ng-if=\"$FORM[fieldName].$error.minlength\">{{ ::messages.minlength }}</div>\n" +
        "    <div class=\"moto-form__error-item moto-form__error-item_maxlength\" ng-if=\"$FORM[fieldName].$error.maxlength\">{{ ::messages.maxlength }}</div>\n" +
        "    <div class=\"moto-form__error-item moto-form__error-item_email\" ng-if=\"$FORM[fieldName].$error.email\">{{ ::messages.email }}</div>\n" +
        "    <div class=\"moto-form__error-item moto-form__error-item_number\" ng-if=\"$FORM[fieldName].$error.number\">{{ ::messages.number }}</div>\n" +
        "    <div class=\"moto-form__error-item moto-form__error-item_min\" ng-if=\"$FORM[fieldName].$error.min\">{{ ::messages.min }}</div>\n" +
        "    <div class=\"moto-form__error-item moto-form__error-item_max\" ng-if=\"$FORM[fieldName].$error.max\">{{ ::messages.max }}</div>\n" +
        "    <div class=\"moto-form__error-item moto-form__error-item_url\" ng-if=\"$FORM[fieldName].$error.url\">{{ ::messages.url }}</div>\n" +
        "    <div class=\"moto-form__error-item moto-form__error-item_max-file-size\" ng-if=\"$FORM[fieldName].$error.maxSize\">{{ ::messages.maxFileSize }}</div>\n" +
        "    <div class=\"moto-form__error-item moto-form__error-item_file-extension\" ng-if=\"fieldType === 'file' && $FORM[fieldName].$error.pattern\">{{ ::messages.fileExtension }}</div>\n" +
        "    <div class=\"moto-form__error-item moto-form__error-item_date\" ng-if=\"fieldType === 'date' && $FORM[fieldName].$error.date\">{{ ::messages.date }}</div>\n" +
        "\n" +
        "    <!-- @TODO : need add tel validator, because user can enter pattern -->\n" +
        "    <div class=\"moto-form__error-item moto-form__error-item_tel\" ng-if=\"fieldType === 'tel' && $FORM[fieldName].$error.pattern\">{{ ::messages.tel }}</div>\n" +
        "    <div class=\"moto-form__error-item moto-form__error-item_pattern\" ng-if=\"fieldType === 'text' && $FORM[fieldName].$error.pattern\">{{ ::messages.pattern }}</div>\n" +
        "</div>\n" +
        "");
}]);

angular.module("@websiteWidgets/pagination/template.ng.html", []).run(["$templateCache", function($templateCache) {
    $templateCache.put("@websiteWidgets/pagination/template.ng.html",
        "<div ng-if=\"Paginator\" class=\"moto-widget moto-widget-pagination moto-preset-default clearfix\" data-widget=\"pagination\" data-preset=\"default\">\n" +
        "\n" +
        "    <ul ng-if=\"Paginator.currentNumber > Paginator.firstNumber\" class=\"moto-pagination-group moto-pagination-group-controls moto-pagination-group_left\">\n" +
        "        <li class=\"moto-pagination-item moto-pagination-item-control moto-pagination-item-control_first\">\n" +
        "            <a ng-href=\"{{ Paginator.first.getLink() }}\" ng-click=\"Paginator.selectPage(Paginator.first);\" class=\"moto-pagination-link\"><i class=\"moto-pagination-link-icon moto-pagination-link-text fa fa-angle-double-left\"></i></a>\n" +
        "        </li>\n" +
        "        <li class=\"moto-pagination-item moto-pagination-item-control moto-pagination-item-control_previous\">\n" +
        "            <a ng-href=\"{{ Paginator.previous.getLink() }}\" ng-click=\"Paginator.selectPage(Paginator.previous);\" class=\"moto-pagination-link\"><i class=\"moto-pagination-link-icon moto-pagination-link-text fa fa-angle-left\"></i></a>\n" +
        "        </li>\n" +
        "    </ul>\n" +
        "\n" +
        "    <ul class=\"moto-pagination-group moto-pagination-group_pages\">\n" +
        "        <li class=\"moto-pagination-item moto-pagination-item-page\" ng-repeat=\"Page in Paginator.pagesInRange\">\n" +
        "            <span ng-if=\"Page.number === Paginator.currentNumber\"\n" +
        "                  class=\"moto-pagination-link moto-pagination-link_active\"><span class=\"moto-pagination-link-text\">{{ Page.number }}</span></span>\n" +
        "            <a ng-if=\"Page.number !== Paginator.currentNumber\" ng-href=\"{{ ::Page.getLink() }}\" ng-click=\"Paginator.selectPage(Page);\" class=\"moto-pagination-link\"><span class=\"moto-pagination-link-text\">{{ Page.number }}</span></a>\n" +
        "        </li>\n" +
        "    </ul>\n" +
        "\n" +
        "    <ul ng-if=\"Paginator.currentNumber < Paginator.lastNumber\" class=\"moto-pagination-group moto-pagination-group-controls moto-pagination-group_right\">\n" +
        "        <li class=\"moto-pagination-item moto-pagination-item-control moto-pagination-item-control_next\">\n" +
        "            <a ng-href=\"{{ Paginator.next.getLink() }}\" ng-click=\"Paginator.selectPage(Paginator.next);\" class=\"moto-pagination-link\"><i class=\"moto-pagination-link-icon moto-pagination-link-text fa fa-angle-right\"></i></a>\n" +
        "        </li>\n" +
        "        <li class=\"moto-pagination-item moto-pagination-item-control moto-pagination-item-control_last\">\n" +
        "            <a ng-href=\"{{ Paginator.last.getLink() }}\" ng-click=\"Paginator.selectPage(Paginator.last);\" class=\"moto-pagination-link\"><i class=\"moto-pagination-link-icon moto-pagination-link-text fa fa-angle-double-right\"></i></a>\n" +
        "        </li>\n" +
        "    </ul>\n" +
        "\n" +
        "</div>\n" +
        "");
}]);