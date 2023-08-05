@auth
    @if(config('basic.push_notification') == 1)
        <div class="notification-panel push-notification">
            <button class="dropdown-toggle">
                <img src="{{asset($themeTrue.'img/icon/notification.png')}}" alt="@lang('notification')"/>
                <span class="badge" v-cloak>@{{items.length}}</span>
            </button>
            <ul class="notification-dropdown">
                <div class="dropdown-box">
                    <li v-for="(item, index) in items" @click.prevent="readAt(item.id, item.description.link)">
                        <a class="dropdown-item" href="javascript:void(0)">
                            <i class="fas fa-bell"></i>
                            <div>
                                <h4 class="golden-text" v-cloak v-html="item.description.text"></h4>
                                <p v-cloak>@{{ item.formatted_date }}</p>
                            </div>
                        </a>
                    </li>
                </div>
                <div class="clear-all fixed-bottom">
                    <a href="javascript:void(0)" v-if="items.length == 0"
                       class="golden-text">@lang('You have no notifications')</a>
                    <a href="javascript:void(0)" role="button" type="button" v-if="items.length > 0"
                       @click.prevent="readAll" class="btn-clear golden-text">@lang('Clear All')</a>
                </div>
            </ul>
        </div>


    @endif
@endauth
