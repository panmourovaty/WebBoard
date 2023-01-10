<?php
echo '
<style>
.loading {
    display: flex;
    justify-content: center;
}
.loading::after {
    content: "";
    width: 50px;
    height: 50px;
    border: 10px solid #dddddd;
    border-top-color: #009579;
    border-radius: 50%;
    animation: loading 1s ease infinite;
}
@keyframes loading {
    to {
        transform: rotate(1turn);
    }
}
</style>
<div style="width: 150px; height: 150px;">
    <div class="loading loading--full-height"></div>
</div>'
?>
