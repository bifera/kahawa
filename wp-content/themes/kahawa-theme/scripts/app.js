
var $ = jQuery;

//----------------- appearance scripts ------------------------------------- //

// 1. function: setHeights --> sets equal height to elements
// 2. function: moveBar --> modifies woocommerce cart info bar position
// 3. function: moveHeader --> modifies woocommerce header position on subpages
// 4. function: simpleLightbox --> add very, very simple lightbox-like effect

//---------- 1. set heights ----------
function setHeights(selector){
    var elements = document.querySelectorAll(selector);
    var height = 0;
    for (var i = 0; i < elements.length; i++){
        if (elements[i].offsetHeight > height) {
            height = elements[i].offsetHeight;
        }
    }
    var style = 'height: '+height+'px;';
    for (var j = 0; j < elements.length; j++){
        elements[j].setAttribute('style', style);
    }
}

$(window).on('load', function(){
    var eventsPage = document.querySelector('.page-template-wydarzenie-archive');
    var mainPage = document.querySelector('.page-template-template-main');
    var eventsTaxPage = document.querySelector('.tax-rodzaj');
    if (eventsPage || mainPage || eventsTaxPage) {
        setHeights('.wydarzenie-short-description');
        setHeights('.wydarzenie-title.title-as-link');
    }
})

//---------- 2. move bar

function moveWCBar(){
    var cartPage = document.querySelector('.woocommerce-cart');
    if (cartPage) {
        var barArea = document.getElementById('content').getElementsByClassName('col-full')[0];
        var barToMove = document.querySelector('#content>.col-full>.woocommerce');
        if (barToMove) {
            var barToInsert = barToMove.cloneNode(true);
            var entryContent = document.getElementById('main').getElementsByClassName('entry-content')[0];
            var contentFirstChild = entryContent.children[0];
            entryContent.insertBefore(barToInsert, contentFirstChild);
            barArea.removeChild(barToMove);
        }
    }
}

document.addEventListener("DOMContentLoaded", function(){
    moveWCBar();
});

//--------- 3. move header

function moveHeader(){
    if ($('body').hasClass('post-type-archive-product')) {
        var headerContainer = $('.woocommerce-products-header');
    } else {
        var headerContainer = $('.entry-header');
    }
    headerContainer.detach().appendTo($('#proper-header-container'));
}

$(window).load(function(){
    moveHeader();
});

//---------- 4. add simple lightbox effect

function addLightboxEffect(){
    if (!$('body').hasClass('page-template-template-main')){
        console.log('light');
    }
}

$(document).ready(function(){
    addLightboxEffect();
    var gallery = $('.gallery');
    gallery.each(function(){
        var items = $(this).find('.gallery-item');
        var counter = 1;
        var lastNumber = items.length-1;
        items.each(function(index, value){
            var item = $(this);
            var anchor = item.find('a');
            var href = anchor.attr('href');
            anchor.attr('data-item', index)
            anchor.on('click', function(e){
                e.preventDefault();
                var thisAnchor = $(this);
                var thisNumber = parseInt(thisAnchor.attr('data-item'));
                counter = thisNumber;
                var box = $('<div class="lightbox-layer">');
                var image = $('<img>').attr('src', href);
                var imageWrapper = $('<div class="lightbox-image-wrapper">');
                var arrowLeft = $('<i class="fa fa-chevron-left prev">');
                var arrowRight = $('<i class="fa fa-chevron-right next">');
                var closeBtn = $('<span class="fa fa-close close">');
                image.appendTo(imageWrapper);
                imageWrapper.append(arrowLeft, arrowRight, closeBtn);
                function checkArrows(){
                    if (thisNumber == 0) {
                        arrowLeft.css('display', 'none');
                    } else if (thisNumber == lastNumber) {
                        arrowRight.css('display', 'none');
                    } else {
                        arrowRight.fadeIn();
                        arrowLeft.fadeIn();
                    }
                }
                checkArrows();
                imageWrapper.appendTo(box);
                box.appendTo($('body'));
                imageWrapper.fadeIn(700);
                closeBtn.on('click', function(){
                    imageWrapper.fadeOut(500, function(){
                        box.fadeOut(500, function(){box.remove();});
                    });
                });

                function handleArrows(val, handle){
                    thisNumber+=val;
                    checkArrows();
                    var anchors = items.find('a');
                    anchors.each(function(){
                        if ($(this).attr('data-item') == thisNumber) {
                            var href = $(this).attr('href');
                            image.attr('src', href);
                        }
                    });
                }

                arrowLeft.on('click', function(){
                    handleArrows(-1, $(this));
                });
                arrowRight.on('click', function(){
                    handleArrows(1, $(this));
                });
            });
        });
    });
})