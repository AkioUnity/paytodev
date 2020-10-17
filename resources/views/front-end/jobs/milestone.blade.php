{{--milestones--}}

<div class="wt-menuform">
    <div class="wt-formtheme wt-skillsform wt-pageorder" style="margin-top: 40px">
        <fieldset>
            <legend>Milestones:</legend>
            <div class="form-group" style="margin-top: 20px">
                <div class="form-group-holder">
                    <input v-model="menu.custom_title" type="text" class="form-control" min="0" placeholder="Milestone name" style="width: 68%;    padding: 10px;">
                    <input v-model="menu.custom_link" type="number" class="form-control" min="0" placeholder="Price" style="width: 15%;padding: 10px;">
                    <span style="position: inherit">( <i>{{ !empty($symbol) ? $symbol['symbol'] : '$' }}</i> )</span>
                </div>
                <div class="wt-btnarea">
                    <a href="javascript:void(0);" class="wt-btn" @click="addMilestone" style="color: #ffffff;">Add</a>
                </div>
            </div>
        </fieldset>
    </div>
    <div class="milestone_list">
        <ul id="skill_list" class="sortable list">
            <li v-for="(customItem, index) in custom_links" :key="index+customItem.count">
                <span>Milestone @{{ index+1 }} - </span>
                <span class="milestone_name" style="width:70%;">@{{customItem.custom_title}} </span>
                <span><em> <i>{{ !empty($symbol) ? $symbol['symbol'] : '$' }}</i>  @{{customItem.custom_link}}</em></span>
                {{--<span class="skill-dynamic-field">--}}
                        {{--<input type="hidden" v-bind:name="'menu[custom_links]['+[customItem.count]+'][custom_link]'" :value="customItem.custom_link">--}}
                        {{--<input type="text" v-bind:name="'menu[custom_links]['+[customItem.count]+'][custom_title]'" :value="customItem.custom_title">--}}
                    {{--</span>--}}
                <div class="wt-rightarea">
                    <a href="javascript:void(0);" class="wt-deleteinfo" @click="removeOrder(index)"><i class="lnr lnr-trash"></i></a>
                </div>
            </li>
        </ul>
    </div>
</div>
