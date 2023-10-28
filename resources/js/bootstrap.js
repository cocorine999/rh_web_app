window._ = require("lodash");

/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

try {
    //window.Popper = require("popper.js").default;
    //window.$ = window.jQuery = require("jquery");

    //require("bootstrap");
} catch (e) {}

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require("axios");

window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

import Echo from "laravel-echo";

window.Pusher = require("pusher-js");

window.Echo = new Echo({
    broadcaster: "pusher",
    key: process.env.MIX_PUSHER_APP_KEY,
    cluster: process.env.MIX_PUSHER_APP_CLUSTER,
    forceTLS: true,
});



var notifications = [];

const NOTIFICATION_TYPES = {
    newPermission: 'App\\Notifications\\NewPermissionNotification',
    confirmPermission: 'App\\Notifications\\ValidatePermissionNotification',
    monthlyPay: 'App\\Notifications\\MonthlyPayNotification',
    confirmPay: 'App\\Notifications\\ConfirmPayNotification',
    dailyReportNotification: 'App\\Notifications\\DailyReportNotification',
    newReportNotification: 'App\\Notifications\\NewReportNotification',
    newMessageNotification: 'App\\Notifications\\NewMessageNotification',


};

$(document).ready(function() {
    // check if there's a logged in user
    if(User.id) {
        $.get('/dashboard/notifications', function (data) {
            if(data.length == 0){
                console.log("data");
                document.getElementById('no-notification').style.display = 'block';
                document.getElementById('load-notification').style.display = 'none';
            }else{
                addNotifications(data, "#notifications");
            }
        });
    }
});

function addNotifications(newNotifications, target) {
    notifications = _.concat(notifications, newNotifications);
    // show only last 5 notifications
    notifications.slice(0, 5);
    showNotifications(notifications, target);
}

function showNotifications(notifications, target) {
    if(notifications.length) {
        var htmlElements = notifications.map(function (notification) {
            return makeNotification(notification);
        });

        $(target + 'Menu').html(htmlElements.join(''));
        $(target).addClass('has-notifications')
    } else {
        $(target + 'Menu').html('<li class="dropdown-header">No notifications</li>');
        $(target).removeClass('has-notifications');
    }
}

//...

// Make a single notification string
function makeNotification(notification) {
    //var to = routeNotification(notification);
    var notification = makeNotificationText(notification)[0];
    //return '<li><a class='text-dark d-flex py-2' href='javascript:void(0)'><div class='flex-shrink-0 me-2 ms-3'><i class='fa fa-fw fa-check-circle text-success'></i></div><div class='flex-grow-1 pe-2'><div class='fw-semibold'>You have a new follower</div><span class='fw-medium text-muted'>15 min ago</span></div></a></li>';

    return '<li> <a class="text-dark media d-flex py-2" href="' + notification.to + '"> <div class="mr-2 ml-3 flex-shrink-0 me-2 ms-3"> <i class="fa fa-fw ' + notification.icon + '"></i> </div> <div class="media-body pr-2 flex-grow-1 pe-2"> <div class="font-w600">' + notification.text + '</div> <small class="fw-medium text-muted">' + moment(notification.date).fromNow(true) + '</small> </div> </a></li>'
    //return '<li> <a class="text-dark media py-2" href="' + notification.to + '"> <div class="mr-2 ml-3"> <i class="fa fa-fw ' + notification.icon + '"></i> </div> <div class="media-body pr-2"> <div class="font-w600">' + notification.text + '</div> <small class="text-muted">' + moment(notification.date).fromNow(true) + '</small> </div> </a></li>'
}

// get the notification route based on it's type
function routeNotification(notification) {
    var to = '?read=' + notification.id;
    if(notification.type === NOTIFICATION_TYPES.follow) {
        to = 'users' + to;
    }
    return '/dashboard/' + to;
}

// get the notification text based on it's type
function makeNotificationText(notification) {
    var text = '';
    var date = '';
    var icon = '';

    var to = '?read=' + notification.id;

    //console.log(notification.data.user_name.replaceAll(/[[\]\\]/g, ''));

    if(notification.type === NOTIFICATION_TYPES.newPermission || notification.type === 'App\\Notifications\\NewPermission') {
        const name = notification.data.user_name;
        to = `permissions/${notification.data.permission_id}` + to;
        date = notification.created_at;
        icon = "fa-plus-circle text-warning";
        text += '<strong>' + name.replaceAll(/[[\]\\]/g, '') + '</strong> vient d\'envoyé une demande la permission';
    }

    if(notification.type === NOTIFICATION_TYPES.newReportNotification) {
        const name = notification.data.user_name;
        to = `rapports/${notification.data.rapport_id}` + to;
        date = notification.created_at;
        icon = "fa-check-circle text-success";
        text += '<strong>' + name.replaceAll(/[[\]\\]/g, '') + '</strong> vient de soumettre son rapport journalier';
    }

    if(notification.type === NOTIFICATION_TYPES.newMessageNotification) {
        const name = notification.data.user_name;
        to = `conversations/${notification.data.message_id}` + to;
        date = notification.created_at;
        icon = "fa-check-circle text-success";
        text += 'Vous avez reçu un nouveau message';// notification.data.data;// 'Vous avez reçu un nouveau message';
    }

    if(notification.type === NOTIFICATION_TYPES.confirmPermission) {
        const name = notification.data.user_name;
        const status = notification.data.status;
        to = `permissions/${notification.data.permission_id}` + to;
        if(status == true){
            date = notification.created_at;
            icon = "fa-check-circle text-success";
            text += 'Votre demande de permission a été accepté par '+ '<strong>' + name.replaceAll(/[[\]\\]/g, '') + '</strong>';
        }
        else{
            date = notification.created_at;
            icon = "fa-times-circle text-danger";
            text += 'Votre demande de permission a été rejété par '+ '<strong>' + name.replaceAll(/[[\]\\]/g, '') + '</strong>';
        }
    }

    if(notification.type === NOTIFICATION_TYPES.confirmPay) {
        const name = notification.data.user_name;
        const status = notification.data.status;
        to = `paiements/${notification.data.paiement_id}` + to;
        if(status == true){
            date = notification.created_at;
            icon = "fa-check-circle text-success";
            text += '<strong>' + name.replaceAll(/[[\]\\]/g, '') + '</strong> vient de confirmer qu\'il a recu son salaire';
        }
        else{
            date = notification.created_at;
            icon = "fa-times-circle text-danger";
            text += '<strong>' + name.replaceAll(/[[\]\\]/g, '') + '</strong> à rejeter votre requête de confirmation de reception de sa paie';
        }
    }

    if(notification.type === NOTIFICATION_TYPES.monthlyPay) {
        const name = notification.data.user_name;
        to = `paiements/${notification.data.paiement_id}` + to;
        date = notification.created_at;
        icon = "fa-plus-circle text-warning";
        text += 'Veuillez confirmer que vous avez recu votre paie';
    }

    if(notification.type === NOTIFICATION_TYPES.dailyReportNotification) {
        const message = notification.data.message;
        to = 'rapports' + to;
        date = notification.created_at;
        icon = "fa-plus-circle text-warning";
        text += message;
    }

    to = '/dashboard/' + to;

    let data = [];

    data.push({
        'text' : text,
        'icon' : icon,
        'date' : date,
        'to' : to,
    });

    return data;
}

function playAudio() {
    var x = new Audio(location.origin+'/assets/media/audios/notifications.mp3');

    document.onclick = function() {
        console.log('cool');
        x.play();
    }

    /* x.addEventListener('load', function () {
        x.play();
    });

    if (playPromise !== undefined) {
        playPromise.then(_ => {
                x.play();
            })
            .catch(error => {
            });

    } */
}

/* var audioElement = document.createElement('audio');

audioElement.setAttribute('src',location.origin+'/assets/media/audios/notifications.mp3');

audioElement.setAttribute('autoplay',true);

console.log(audioElement); */

window.Echo.private(`App.Models.User.${User.id}`).notification(
    (notification) => {


        var audioElement = document.createElement('audio');

        audioElement.setAttribute('src',location.origin+'/assets/media/audios/notifications.mp3');

        audioElement.setAttribute('autoplay',true);

        document.getElementById('count-notifications').innerHTML = parseInt(count_notifications)+1;

        addNotifications([notification], '#notifications');

        $('#page-container').load(location.href + ' #page-container>*', '');



        /* if(notification.type === NOTIFICATION_TYPES.newPermission) {
            const name = notification.data.user_name;
            text += '<strong>' + name.replaceAll(/[[\]\\]/g, '') + '</strong> vient d\'envoyé une demande la permission you';
        }

        if(notification.type === NOTIFICATION_TYPES.confirmPermission) {
            const name = notification.data.user_name;
            const status = notification.data.status;
            if(status == true){
                text += 'Votre demande de permission a été accepté par '+ '<strong>' + name.replaceAll(/[[\]\\]/g, '') + '</strong>';
            }
            else{
                text += 'Votre demande de permission a été rejété par '+ '<strong>' + name.replaceAll(/[[\]\\]/g, '') + '</strong>';
            }
        }

        if(notification.type === NOTIFICATION_TYPES.confirmPay) {
            const name = notification.data.user_name;
            const status = notification.data.status;
            if(status == true){
                text += '<strong>' + name.replaceAll(/[[\]\\]/g, '') + '</strong> vient de confirmer son paiement';
            }
            else{
                text += '<strong>' + name.replaceAll(/[[\]\\]/g, '') + '</strong> n\'a pas reçu sa paie';
            }
        }

        if(notification.type === NOTIFICATION_TYPES.monthlyPay) {
            const name = notification.data.user_name;
            text += '<strong>' + name.replaceAll(/[[\]\\]/g, '') + '</strong> vient d\'envoyé une demande la permission you';
        }

        if(notification.type === NOTIFICATION_TYPES.dailyReportNotification) {
            const message = notification.data.message;
            text += message;
        } */

    }
);
