<?php

class RaiaDrogasil_LimeLocker_Helper_Data extends Mage_Core_Helper_Abstract
{
    protected $hasBlockedSaleInCart = null;

    /**
     * Retorna TRUE se o locker estiver habilitado e não houver produto controlado no carrinho
     *
     * @return boolean
     */
    public function isLockerEnabled()
    {
        return
            Mage::helper('raiadrogasil_compreretire/util')->isCrLockerEnabled()
            && $this->getHasBlockedSaleInCart() === false;
    }

    /**
     * Verifica se tem produto controlado no carrinho
     *
     * @return boolean
     */
    public function getHasBlockedSaleInCart()
    {
        // Se houver cache in-memory, retorna o que está no cache
        if (! is_null($this->hasBlockedSaleInCart)) {
            return $this->hasBlockedSaleInCart;
        }

        $this->hasBlockedSaleInCart = false;

        /** @var Mage_Checkout_Model_Cart $cart */
        $cart = Mage::getModel('checkout/cart')->getQuote();
        $isBlockedSaleSellEnabled = Mage::getStoreConfig('compreretire/blocked_sale_cr/enabled');

        if ($isBlockedSaleSellEnabled) {
            // Levanta as categorias que são para FORÇAR o blocked sale
            $blockedCategories = unserialize(Mage::getStoreConfig('compreretire/blocked_sale_cr/categorias'));
            $blockedCategoryList = [];
            if (is_array($blockedCategories)) {
                foreach ($blockedCategories as $value) {
                    $blockedCategoryList[] = $value['blocked'];
                }
            }

            foreach ($cart->getAllItems() as $item) {
                $_product = $item->getProduct();
                if ($_product->getBlockedSale() && !in_array($_product->getData('subgrupo'), $blockedCategoryList)) {
                    $this->hasBlockedSaleInCart = true;
                    break;
                }
            }
        }

        return $this->hasBlockedSaleInCart;
    }
}

