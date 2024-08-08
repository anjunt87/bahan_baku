<style>
    /* Base styles for the toggle button */
    .toggle-button {
        width: 50px;
        height: 20px;
        background-color: #ccc;
        border-radius: 15px;
        position: relative;
        cursor: pointer;
    }

    /* Neutral state */
    .toggle-button[data-state="neutral"] {
        background-color: #ccc;
    }

    /* On state (approve) */
    .toggle-button[data-state="on"] {
        background-color: #4CAF50;
    }

    /* Off state (rejected) */
    .toggle-button[data-state="off"] {
        background-color: #f44336;
    }

    /* The knob */
    .toggle-knob {
        width: 20px;
        height: 20px;
        background-color: white;
        border-radius: 50%;
        position: absolute;
        top: 0;
        left: 15px;
        transition: left 0.3s;
    }

    /* Knob positions */
    .toggle-button[data-state="neutral"] .toggle-knob {
        left: 15px;
    }

    .toggle-button[data-state="on"] .toggle-knob {
        left: 30px;
    }

    .toggle-button[data-state="off"] .toggle-knob {
        left: 0;
    }
</style>