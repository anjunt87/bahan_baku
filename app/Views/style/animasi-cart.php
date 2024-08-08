<style>
    /* Outbound Cart Animation */
    .cart-animation-outbound {
        animation: bounce-outbound 0.5s;
    }

    @keyframes bounce-outbound {

        0%,
        100% {
            transform: translateY(0);
        }

        50% {
            transform: translateY(-10px);
        }
    }

    .cart-count-update-outbound {
        animation: scaleUp-outbound 0.5s;
    }

    @keyframes scaleUp-outbound {
        0% {
            transform: scale(1);
        }

        50% {
            transform: scale(1.2);
        }

        100% {
            transform: scale(1);
        }
    }

    /* Preorder Cart Animation */
    .cart-animation-preorder {
        animation: bounce-preorder 0.5s;
    }

    @keyframes bounce-preorder {

        0%,
        100% {
            transform: translateY(0);
        }

        50% {
            transform: translateY(-15px);
        }
    }

    .cart-count-update-preorder {
        animation: scaleUp-preorder 0.5s;
    }

    @keyframes scaleUp-preorder {
        0% {
            transform: scale(1);
        }

        50% {
            transform: scale(1.3);
        }

        100% {
            transform: scale(1);
        }
    }
</style>