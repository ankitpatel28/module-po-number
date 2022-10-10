/*global define*/
define([
    'knockout',
    'jquery',
    'mage/url',
    'Magento_Ui/js/form/form',
    'Magento_Customer/js/model/customer',
    'Magento_Checkout/js/model/quote',
    'Magento_Checkout/js/model/url-builder',
    'Magento_Checkout/js/model/error-processor',
    'Magento_Checkout/js/model/cart/cache',
    'Ankitdev_PoNumber/js/model/checkout/po-number-checkout-form'
], function(ko, $, urlFormatter, Component, customer, quote, urlBuilder, errorProcessor, cartCache, formData) {
    'use strict';

    return Component.extend({
        PoNumber: ko.observable(null),
        formData: formData.PoNumberData,

        /**
         * Initialize component
         *
         * @returns {exports}
         */
        initialize: function () {
            var self = this;
            this._super();
            formData = this.source.get('poNumberCheckoutForm');
            var formDataCached = cartCache.get('po-number-form');
            if (formDataCached) {
                formData = this.source.set('poNumberCheckoutForm', formDataCached);
            }

            this.PoNumber.subscribe(function(change){
                self.formData(change);
            });

            return this;
        },

        /**
         * Trigger save method if form is change
         */
        onFormChange: function () {
            this.savePoNumber();
        },

        /**
         * Form submit handler
         */
        savePoNumber: function() {
            this.source.set('params.invalid', false);
            this.source.trigger('poNumberCheckoutForm.data.validate');

            if (!this.source.get('params.invalid')) {
                var formData = this.source.get('poNumberCheckoutForm');
                var quoteId = quote.getQuoteId();
                var isCustomer = customer.isLoggedIn();
                var url;

                if (isCustomer) {
                    url = urlBuilder.createUrl('/carts/mine/set-order-po-number-fields', {});
                } else {
                    url = urlBuilder.createUrl('/guest-carts/:cartId/set-order-po-number', {cartId: quoteId});
                }

                var payload = {
                    cartId: quoteId,
                    PoNumber: formData
                };
                var result = true;
                $.ajax({
                    url: urlFormatter.build(url),
                    data: JSON.stringify(payload),
                    global: false,
                    contentType: 'application/json',
                    type: 'PUT',
                    async: true
                }).done(
                    function (response) {
                        cartCache.set('po-number-form', formData);
                        result = true;
                    }
                ).fail(
                    function (response) {
                        result = false;
                        errorProcessor.process(response);
                    }
                );

                return result;
            }
        }
    });
});