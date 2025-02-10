<!-- loading_spinner.php -->
<div id="loadingSpinnerContainer" style="display: none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); text-align: center; z-index: 9999;">
    <div class="spinner-border text-primary" role="status">
        <span class="visually-hidden">Loading...</span>
    </div>
    <p style="margin-top: 10px; font-weight: bold;">Now loading, please wait...</p>
</div>

<script>
    function showLoading() {
        document.getElementById("loadingSpinnerContainer").style.display = "block";
        document.getElementById("loginForm").style.display = "none";
    }
</script>
