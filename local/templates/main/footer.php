<footer class="footer">

</footer>
<script src="https://unpkg.com/imask"></script>
<script>
    document.addEventListener('DOMContentLoaded', () => {

        const inputElement = document.querySelector('input[type="tel"]');
        const maskOptions = { // создаем объект параметров
            mask: '+{7} (000) 000-00-00' // задаем единственный параметр mask
        }
        if(inputElement) {
            IMask(inputElement, maskOptions) // запускаем плагин с переданными параметрами
        }
    })
</script>
<script src="<?= SITE_TEMPLATE_PATH?>/js/form.js"></script>
</body>
</html>