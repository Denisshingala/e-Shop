<style>
    #loader {
        position: relative;
        top: 0%;
        left: 0%;
        z-index: -100;
        height: 100vh;
        width: 100vw;
        margin: 0%;
        padding: 0%;
        overflow: hidden;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: row;
    }

    .container {
        width: max-content;
    }

    .loader-circle {
        margin: 0 15px;
        float: left;
        background: black;
        border: none;
        border-radius: 50%;
        width: 20px;
        height: 20px;
        list-style: none;
        animation: loader 1500ms ease;
        animation-iteration-count: infinite;
    }

    li:nth-child(1) {
        animation-delay: 0s;
    }

    li:nth-child(2) {
        animation-delay: 300ms;
    }

    li:nth-child(3) {
        animation-delay: 600ms;
    }

    @keyframes loader {
        from {
            transform: scale(1, 1);
            opacity: 1;
        }

        to {
            transform: scale(2, 2);
            opacity: 0;
        }
    }
</style>

<div class="loader" id="loader">
    <div class="container">
        <li class="loader-circle"></li>
        <li class="loader-circle"></li>
        <li class="loader-circle"></li>
    </div>
</div>
<script>
    setTimeout(() => {
        document.getElementById('loader').style = "Display:none";
    }, 5000)
</script>