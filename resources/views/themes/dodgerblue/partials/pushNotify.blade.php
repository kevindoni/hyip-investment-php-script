@auth
    @if(config('basic.push_notification') == 1)
        <div class="notification-panel push-notification">
            <button class="dropdown-toggle">
                <i class="fal fa-bell"></i>
                <span class="count" v-cloak>@{{items.length}}</span>
            </button>
            <ul class="notification-dropdown">
                <div class="dropdown-box list-unstyled">
                    <li v-for="(item, index) in items" @click.prevent="readAt(item.id, item.description.link)">
                        <a class="dropdown-item" href="javascript:void(0)">
                            <i class="fal fa-bell"></i>
                            <div class="text">
                                <p v-cloak v-html="item.description.text"></p>
                                <span class="time" v-cloak>@{{ items.formatted_date }}</span>
                            </div>
                        </a>
                    </li>
                </div>

                <div class="clear-all fixed-bottom">
                    <a href="javascript:void(0)" v-if="items.length == 0"
                       class="">@lang('You have no notifications')</a>
                    <a href="javascript:void(0)" role="button" type="button" v-if="items.length > 0"
                       @click.prevent="readAll" class="btn-clear">@lang('Clear All')</a>
                </div>
            </ul>
        </div>
    @endif
@endauth

