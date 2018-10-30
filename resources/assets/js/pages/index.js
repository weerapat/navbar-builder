$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready(function () {
    var $form = $('#navigation-cms');
    var $cmsBarArr = [];
    var max = 10;
    var navigationUrl = 'navigation-bar/setting';
    // var navigationUrl = 'navbar.json';
    var start = 0;
    $.ajax({
        url: navigationUrl,
        success: function (data) {
            if (data.items !== undefined) {
                start = 0;
                $.each(data.items, function (key, value) {
                    var html = $('#block-data').clone();
                    html.show();
                    html.attr('id', '');
                    html.find('#cmsbar-title-th').attr('name', 'cmsbar[' + start + '][title][th]');
                    html.find('#cmsbar-title-en').attr('name', 'cmsbar[' + start + '][title][en]');
                    html.find('#cmsbar-realated-id-en').attr('name', 'cmsbar[' + start + '][related_article_id][en]');
                    html.find('#cmsbar-realated-id-th').attr('name', 'cmsbar[' + start + '][related_article_id][th]');
                    html.find('#cmsbar-ads-id').attr('name', 'cmsbar[' + start + '][ads_id]');
                    if (value.type === 'standard') {
                        html.find('#cmsbar-title-th').val(value.title.th);
                        html.find('#cmsbar-title-en').val(value.title.en);
                        html.find('#cmsbar-realated-id-en').val(value.related_article_id.en);
                        html.find('#cmsbar-realated-id-th').val(value.related_article_id.th);
                        html.find('#cmsbar-ads-id').val(value.ads_id);
                    }
                    html.find('#cmsbar-link-th').attr('name', 'cmsbar[' + start + '][link][th]').val(value.link.th);
                    html.find('#cmsbar-link-en').attr('name', 'cmsbar[' + start + '][link][en]').val(value.link.en);
                    html.find('#btn-add').attr('name', 'btn-add-' + start);
                    html.find('#btn-add-promotions').attr('name', 'btn-add-promotions-' + start);
                    html.find('#cmsbar-categoryname-en')
                        .attr('name', 'cmsbar[' + start + '][category_name][en]').val(value.category_name.en);
                    html.find('#cmsbar-categoryname-th')
                        .attr('name', 'cmsbar[' + start + '][category_name][th]').val(value.category_name.th);
                    html.find('#cmsbar-color').attr('name', 'cmsbar[' + start + '][color]').val(value.color);
                    html.find('#cmsbar-order').attr('name', 'cmsbar[' + start + '][order]').val(value.order);
                    $('#navigation-cms').append(html);
                    if (value.pages !== undefined) {
                        $.each(value.pages, function (subKey, subValue) {
                            var subNavHtml = $('#sub-category').clone();
                            subNavHtml.show();
                            subNavHtml.attr('id', '');
                            subNavHtml.find('#sub-cat-title-th').attr('name', 'cmsbar[' + start + '][pages][' + subKey + '][title][th]').val(subValue.title.th);
                            subNavHtml.find('#sub-cat-title-en').attr('name', 'cmsbar[' + start + '][pages][' + subKey + '][title][en]').val(subValue.title.en);
                            subNavHtml.find('#sub-cat-link-th').attr('name', 'cmsbar[' + start + '][pages][' + subKey + '][link][th]').val(subValue.link.th);
                            subNavHtml.find('#sub-cat-link-en').attr('name', 'cmsbar[' + start + '][pages][' + subKey + '][link][en]').val(subValue.link.en);
                            subNavHtml.find('#sub-cat-icons').attr('name', 'cmsbar[' + start + '][pages][' + subKey + '][icon]').val(subValue.icon);
                            subNavHtml.find('#sub-cat-orders').attr('name', 'cmsbar[' + start + '][pages][' + subKey + '][order]').val(subValue.order);
                            html.find('#sub-catagory-container').append(subNavHtml);
                        });
                    }
                    if (value.promotions !== undefined) {
                        $.each(value.promotions, function (promoKey, promoValue) {
                            var promotionHtml = $('#sub-promotion').clone();
                            promotionHtml.show();
                            promotionHtml.attr('id', '');
                            promotionHtml.find('#promotion-title-th').attr('name', 'cmsbar[' + start + '][promotions][' + promoKey + '][title][th]').val(promoValue.title.th);
                            promotionHtml.find('#promotion-title-en').attr('name', 'cmsbar[' + start + '][promotions][' + promoKey + '][title][en]').val(promoValue.title.en);
                            promotionHtml.find('#promotion-link-th').attr('name', 'cmsbar[' + start + '][promotions][' + promoKey + '][link][th]').val(promoValue.link.th);
                            promotionHtml.find('#promotion-link-en').attr('name', 'cmsbar[' + start + '][promotions][' + promoKey + '][link][en]').val(promoValue.link.en);
                            promotionHtml.find('#promotion-orders').attr('name', 'cmsbar[' + start + '][promotions][' + promoKey + '][order]').val(promoValue.order);
                            html.find('#promotions-container').append(promotionHtml);
                        });
                    }
                    start += 1;
                });
            }
        }
    });
    $('#add-new-cat').click(function () {
        var html = $('#block-data').clone();
        html.show();
        html.attr('id', '');
        html.find('#cmsbar-title-th').attr('name', 'cmsbar[' + start + '][title][th]');
        html.find('#cmsbar-title-en').attr('name', 'cmsbar[' + start + '][title][en]');
        html.find('#cmsbar-link-th').attr('name', 'cmsbar[' + start + '][link][th]');
        html.find('#cmsbar-link-en').attr('name', 'cmsbar[' + start + '][link][en]');
        html.find('#btn-add').attr('name', 'btn-add-' + start);
        html.find('#btn-add-promotions').attr('name', 'btn-add-promotions-' + start);
        html.find('#cmsbar-categoryname-en')
            .attr('name', 'cmsbar[' + start + '][category_name][en]');
        html.find('#cmsbar-categoryname-th')
            .attr('name', 'cmsbar[' + start + '][category_name][th]');
        html.find('#cmsbar-color').attr('name', 'cmsbar[' + start + '][color]');
        html.find('#cmsbar-ads-id').attr('name', 'cmsbar[' + start + '][ads_id]');
        html.find('#cmsbar-order').attr('name', 'cmsbar[' + start + '][order]');
        html.find('#cmsbar-realated-id-en').attr('name', 'cmsbar[' + start + '][related_article_id][en]');
        html.find('#cmsbar-realated-id-th').attr('name', 'cmsbar[' + start + '][related_article_id][th]');
        $('#navigation-cms').append(html);
        start += 1;
    });
    $form.on('click', '.btn-add', function (e) {
        e.preventDefault();
        var currentPos = $(this).attr('name').replace('btn-add-', '');
        var lastIndex = $(this).parent().next().find('.pages-title-en').length;
        var subNavHtml = $('#sub-category').clone();
        subNavHtml.show();
        subNavHtml.attr('id', '');
        subNavHtml.find('#sub-cat-title-th').attr('name', 'cmsbar[' + currentPos + '][pages][' + lastIndex + '][title][th]');
        subNavHtml.find('#sub-cat-title-en').attr('name', 'cmsbar[' + currentPos + '][pages][' + lastIndex + '][title][en]');
        subNavHtml.find('#sub-cat-link-th').attr('name', 'cmsbar[' + currentPos + '][pages][' + lastIndex + '][link][th]');
        subNavHtml.find('#sub-cat-link-en').attr('name', 'cmsbar[' + currentPos + '][pages][' + lastIndex + '][link][en]');
        subNavHtml.find('#sub-cat-icons').attr('name', 'cmsbar[' + currentPos + '][pages][' + lastIndex + '][icon]');
        subNavHtml.find('#sub-cat-orders').attr('name', 'cmsbar[' + currentPos + '][pages][' + lastIndex + '][order]');
        $(this).parent().next().append(subNavHtml);
    });
    $form.on('click', '.btn-add-promotions', function (e) {
        e.preventDefault();
        var currentPos = $(this).attr('name').replace('btn-add-promotions-', '');
        var lastIndex = $(this).parent().next().find('.promotion-title-en').length;
        var promotionHtml = $('#sub-promotion').clone();
        promotionHtml.show();
        promotionHtml.attr('id', '');
        promotionHtml.find('#promotion-title-th').attr('name', 'cmsbar[' + currentPos + '][promotions][' + lastIndex + '][title][th]');
        promotionHtml.find('#promotion-title-en').attr('name', 'cmsbar[' + currentPos + '][promotions][' + lastIndex + '][title][en]');
        promotionHtml.find('#promotion-link-th').attr('name', 'cmsbar[' + currentPos + '][promotions][' + lastIndex + '][link][th]');
        promotionHtml.find('#promotion-link-en').attr('name', 'cmsbar[' + currentPos + '][promotions][' + lastIndex + '][link][en]');
        promotionHtml.find('#promotion-orders').attr('name', 'cmsbar[' + currentPos + '][promotions][' + lastIndex + '][order]');
        $(this).parent().next().append(promotionHtml);
    });
    $form.on('click', '.btn-delete', function (e) {
        $(this).parent().parent().parent().remove();
    });
    $form.on('click', '.btn-delete-sub', function (e) {
        $(this).parent().parent().remove();
    });
    $('#save-nav').click(function () {
        $cmsBarArr = [];
        $form.validate({
            focusInvalid: false,
            errorPlacement: function (error, element) {
            },
            invalidHandler: function (form, validator) {
                if (!validator.numberOfInvalids())
                    return;
                $('html, body').animate({
                    scrollTop: $(validator.errorList[0].element).offset().top - 64
                }, 1000);
            }
        });
        if ($form.valid()) {
            var maxCount = $('.cmsbar-category-th').length - 1;
            for (var i = 0; i < maxCount; i++) {
                if ($('input[name="cmsbar[' + i + '][category_name][th]"]').val() !== undefined) {
                    var tempArr = {
                        title: {},
                        category_name: {},
                        link: {},
                        related_article_id: {},
                        pages: [],
                        promotions: []
                    };
                    tempArr.title.th = $('input[name="cmsbar[' + i + '][title][th]"]').val();
                    tempArr.title.en = $('input[name="cmsbar[' + i + '][title][en]"]').val();
                    tempArr.color = $('input[name="cmsbar[' + i + '][color]"]').val();
                    tempArr.ads_id = $('input[name="cmsbar[' + i + '][ads_id]"]').val();
                    tempArr.order = parseInt($('input[name="cmsbar[' + i + '][order]"]').val());
                    tempArr.related_article_id.th = parseInt($('input[name="cmsbar[' + i + '][related_article_id][th]"]').val());
                    tempArr.related_article_id.en = parseInt($('input[name="cmsbar[' + i + '][related_article_id][en]"]').val());
                    tempArr.category_name.th = $('input[name="cmsbar[' + i + '][category_name][th]"]').val();
                    tempArr.category_name.en = $('input[name="cmsbar[' + i + '][category_name][en]"]').val();
                    tempArr.link.th = $('input[name="cmsbar[' + i + '][link][th]"]').val();
                    tempArr.link.en = $('input[name="cmsbar[' + i + '][link][en]"]').val();
                    if (tempArr.color === "") {
                        tempArr.color = null;
                    }
                    if (tempArr.ads_id === "") {
                        tempArr.ads_id = null;
                    }
                    if (tempArr.order === "") {
                        tempArr.order = null;
                    }
                    if (tempArr.related_article_id.en === "") {
                        tempArr.related_article_id.en = null;
                    }
                    if (tempArr.related_article_id.th === "") {
                        tempArr.related_article_id.th = null;
                    }
                    for (var k = 0; k < max; k++) {
                        if ($('input[name="cmsbar[' + i + '][pages][' + k + '][title][th]"]').val() !== undefined &&
                            $('input[name="cmsbar[' + i + '][pages][' + k + '][title][th]"]').val() !== "") {
                            var tempSubLink = {
                                title: {},
                                link: {}
                            };
                            tempSubLink.title.en = $('input[name="cmsbar[' + i + '][pages][' + k + '][title][en]"]').val();
                            tempSubLink.title.th = $('input[name="cmsbar[' + i + '][pages][' + k + '][title][th]"]').val();
                            tempSubLink.link.en = $('input[name="cmsbar[' + i + '][pages][' + k + '][link][en]"]').val();
                            tempSubLink.link.th = $('input[name="cmsbar[' + i + '][pages][' + k + '][link][th]"]').val();
                            tempSubLink.order = parseInt($('input[name="cmsbar[' + i + '][pages][' + k + '][order]"]').val());
                            tempSubLink.icon = $('input[name="cmsbar[' + i + '][pages][' + k + '][icon]"]').val();
                            tempArr.pages.push(tempSubLink);
                        }
                    }
                    for (var j = 0; j < max; j++) {
                        if ($('input[name="cmsbar[' + i + '][promotions][' + j + '][title][th]"]').val() !== undefined &&
                            $('input[name="cmsbar[' + i + '][promotions][' + j + '][title][th]"]').val() !== "") {
                            var tempPromotions = {
                                title: {},
                                link: {}
                            };
                            tempPromotions.title.en = $('input[name="cmsbar[' + i + '][promotions][' + j + '][title][en]"]').val();
                            tempPromotions.title.th = $('input[name="cmsbar[' + i + '][promotions][' + j + '][title][th]"]').val();
                            tempPromotions.link.en = $('input[name="cmsbar[' + i + '][promotions][' + j + '][link][en]"]').val();
                            tempPromotions.link.th = $('input[name="cmsbar[' + i + '][promotions][' + j + '][link][th]"]').val();
                            tempPromotions.order = parseInt($('input[name="cmsbar[' + i + '][promotions][' + j + '][order]"]').val());
                            tempArr.promotions.push(tempPromotions);
                        }
                    }
                    if (tempArr.pages.length === 0) {
                        tempArr.type = 'link'
                    } else {
                        tempArr.type = 'standard';
                    }
                    $cmsBarArr.push(tempArr);
                }
            }
            var $cmsBarData = {
                items: $cmsBarArr,
                related_article_amount: 3
            };
            $.ajax({
                type: "PUT",
                dataType: 'json',
                async: false,
                url: navigationUrl,
                data: $cmsBarData,
                success: function (data) {
                    $('.alert-success').removeClass('hidden');
                    setTimeout(function () {
                        window.location.reload();
                    }, 2000);
                },
                error: function (error) {
                    $('.alert-danger').removeClass('hidden').find('span').text(error.responseText);
                }
            });
        }
    })
});