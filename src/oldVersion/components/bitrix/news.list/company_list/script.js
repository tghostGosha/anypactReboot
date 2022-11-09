$(document).ready(function(){
    //выбран профиль компании
    $(document).on('click', '.js-auth_company', function(e){
        e.preventDefault();
        let idCompany = $(this).attr('data-id');
        preload('show');

        $.post(
            "/response/ajax/select_profile.php", {
                id_element: idCompany,
                action: 'company'
            },
            onAjaxSuccess
        );

        function onAjaxSuccess(data) {
            let result = JSON.parse(data);
            if(result['TYPE']=='ERROR'){
                preload('hide');
                showResult('#popup-error','Ошибка сохранения', result['VALUE']);
            }
            if(result['TYPE']=='SUCCESS'){
                preload('hide');
                location.href = '/';
            }
        }
    });

    //выбран профиль полдьзователя
    $(document).on('click', '.js-auth_user', function(e){
        e.preventDefault();
        preload('show');

        $.post(
            "/response/ajax/select_profile.php", {
                action: 'user'
            },
            onAjaxSuccess
        );

        function onAjaxSuccess(data) {
            let result = JSON.parse(data);
            if(result['TYPE']=='ERROR'){
                preload('hide');
                showResult('#popup-error','Ошибка сохранения', result['VALUE']);
            }
            if(result['TYPE']=='SUCCESS'){
                preload('hide');
                location.href = '/';
            }
        }
    });

    //принять приглашение компании и перейти по профилю компании
    $(document).on('click', '.js-accept_company', function(e){
        e.preventDefault();
        let idCompany = $(this).attr('data-id');
        preload('show');

        $.post(
            "/response/ajax/select_profile.php", {
                id_element: idCompany,
                action: 'accept_company'
            },
            onAjaxSuccess
        );

        function onAjaxSuccess(data) {
            let result = JSON.parse(data);
            if(result['TYPE']=='ERROR'){
                preload('hide');
                showResult('#popup-error','Ошибка сохранения', result['VALUE']);
            }
            if(result['TYPE']=='SUCCESS'){
                preload('hide');
                location.href = '/';
            }
        }
    });

    //принять приглашение компании
    $(document).on('click', '.js-refus_company', function(e){
        e.preventDefault();
        let idCompany = $(this).attr('data-id');
        preload('show');

        $.post(
            "/response/ajax/select_profile.php", {
                id_element: idCompany,
                action: 'refus_company'
            },
            onAjaxSuccess
        );

        function onAjaxSuccess(data) {
            let result = JSON.parse(data);
            if(result['TYPE']=='ERROR'){
                preload('hide');
                showResult('#popup-error','Ошибка сохранения', result['VALUE']);
            }
            if(result['TYPE']=='SUCCESS'){
                preload('hide');
                location.reload();
            }
        }
    });
});