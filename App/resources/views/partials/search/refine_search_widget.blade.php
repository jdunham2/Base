<div class="refine-search-widget">
    <form action="{{ currentPage() }}">
        <h3 class="aside-header">Refine Your Search</h3>
        <hr class="no-margin"/>
        <br/>

        <div class="clearfix"></div>
        <div class="refine-group">
            @include('partials.search.inputs.make')
        </div>

        <div class="clearfix"></div>
        <div class="refine-group">
            @include('partials.search.inputs.model')
        </div>

        <div class="clearfix"></div>
        <div class="refine-group">
            @include('partials.search.inputs.new_used')
        </div>

        <div class="clearfix"></div>
        <div class="refine-group">
            @include('partials.search.inputs.max_price')
        </div>

        <div class="clearfix"></div>
        <div class="refine-group">
            @include('partials.search.inputs.min_price')
        </div>

        <div class="clearfix"></div>
        <div class="refine-group">
            @include('partials.search.inputs.keyword')
        </div>

        <div class="clearfix"></div>
        <div class="refine-group">
            @include('partials.search.inputs.zip')
        </div>

        <div class="clearfix"></div>
        <div class="refine-group">
            @include('partials.search.inputs.radius')
        </div>

        <div class="clearfix"></div>
        <div class="refine-group">
            @include('partials.search.inputs.body_style')
        </div>

        <br/>

        <input type="checkbox"
               name="only_pictures" {{ isChecked("only_pictures", 1) }} value="1"/> Has Image
        <br><br>

        <div class="collapse refine-collapse text-left">

            <div class="clearfix"></div>
            <div class="refine-group">
                @include('partials.search.inputs.fuel_type')
            </div>

            <div class="clearfix"></div>
            <div class="refine-group">
                @include('partials.search.inputs.transmission')
            </div>

            <div class="clearfix"></div>
            <div class="refine-group">
                @include('partials.search.inputs.exterior_colors')
            </div>

            <div class="clearfix"></div>
            <div class="refine-group">
                @include('partials.search.inputs.mileage')
            </div>

        </div>

        <span data-toggle="collapse" data-target=".refine-collapse" class="btn btn-default pull-left"
           onclick="javascript:MoreClicked(this,'- Less','+ More')">+ More</span>


        <input type="submit" class="pull-right btn btn-primary " value="Submit"/>
        <div class="clear"></div>
        <br/>
    </form>
</div>