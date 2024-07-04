<script>
    var captchaId = "{{ env('GEETEST_ID') }}"

    initGeetest4({
        captchaId: captchaId,
    }, function (geetest) {
        window.geetest = geetest
        geetest
            .appendTo("#{{ $elementId }}")
            .onSuccess(function (e) {
                let result = geetest.getValidate();
                $("#{{ $elementId }}").parent().append('<input type="hidden" name="geetest_captcha_data" value="' + result + '">');
            })
    });

</script>
