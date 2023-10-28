require('./bootstrap');

/* window._ = require('lodash');
window.$ = window.jQuery = require('jquery');

window.Pusher = require('pusher-js');
import Echo from "laravel-echo";

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: 'a7169ff20f18ebfeadb7',
    cluster: 'ap2',
    encrypted: true
});

var notifications = [];

const NOTIFICATION_TYPES = {
    follow: 'App\\Notifications\\UserFollowed'
};
var notifications = [];

//...

$(document).ready(function() {
    if(Laravel.userId) {
        //...
        window.Echo.private(`App.User.${Laravel.userId}`)
            .notification((notification) => {
                console.log(notification);
                addNotifications([notification], '#notifications');
            });
    }
});

//...
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
    var to = routeNotification(notification);
    var notificationText = makeNotificationText(notification);

    return '<li><a class="text-dark media py-2" href="' + to + '">'
    + notificationText +
    '</a></li>';
}

//...
function routeNotification(notification) {
    var to = `?read=${notification.id}`;
    if(notification.type === NOTIFICATION_TYPES.follow) {
        to = 'users' + to;
    } else if(notification.type === NOTIFICATION_TYPES.newPermission) {
        const permissionId = notification.data.permission_id;
        to = `permissions/${permissionId}` + to;
    }
    return '/dashboard/' + to;
}

// get the notification text based on it's type
function makeNotificationText(notification) {
    var text = '';
    if(notification.type === NOTIFICATION_TYPES.newPermission) {
        const name = notification.data.user_name;
        text += '<strong>' + name + '</strong> vient d\'envoyé une demande la permission you';
    }
    return text;
}

 */
