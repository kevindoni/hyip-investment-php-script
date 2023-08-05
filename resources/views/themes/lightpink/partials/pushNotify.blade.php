@auth
    @if(config('basic.push_notification') == 1)
<!-- notification panel -->
<div class="notification-panel" id="pushNotificationArea">
    <button class="dropdown-toggle">
        <i class="far fa-bell"></i>
        <span v-if="items.length > 0" class="count" v-cloak>@{{items.length}}</span>
    </button>
    <ul :class = "(items.length > 0)?'notification-dropdown':'no-notification-dropdown'">
        <div v-if="items.length > 0" class="dropdown-box">
            <li v-for="(item, index) in items" @click.prevent="readAt(item.id, item.description.link)">
                <a class="dropdown-item" href="javascript:void(0)">
                    <i class="fal fa-bell"></i>
                    <div class="text">
                        <h4 class="notification-heading" v-cloak v-html="item.description.text"></h4>
                        <p v-cloak>@{{ item.formatted_date }}</p>
                    </div>
                </a>
            </li>
        </div>

        <div class="clear-all fixed-bottom">
            <a href="javascript:void(0)" v-if="items.length > 0" @click.prevent="readAll">@lang('Clear all')</a>
            <a href="javascript:void(0)" v-if="items.length == 0"
               @click.prevent="readAll">@lang('You have no notifications')</a>
        </div>
    </ul>
</div>
    @endif
@endauth
