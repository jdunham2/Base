<div class="fullsearchwidget-title shop4autos-green" style="height: 50px">
    <a href="javascript:AdvancedSearch()"><img src="images/expand_search_o.gif" id="expand_search_img"
                                               class="pull-right fullsearchwidget-title-arrow"/></a>
    <h3 class="fullsearchwidget-title-text">
        Quick Search
    </h3>
</div>

<div class="search-panel">

    <!--SEARCH FORM-->

    <form id="search_form" method="post">
        <input type="hidden" name="mod" value="search"/>
        <input type="hidden" name="search_type" value="search_form"/>
        <input type="hidden" name="type" value="1">

        <div id="search_form_container">

            <div class="form-group">
                <?php View('partials.search.inputs.new_used'); ?>
            </div>

            <div class="form-group">
                <?php View('partials.search.inputs.make'); ?>
            </div>

            <div class="form-group">
                <?php View('partials.search.inputs.model'); ?>
            </div>

            <!--            Location is redundant, also confusing - does it mean your location or location of vehicle -->
            <!--            <div class="form-group">-->
            <!--                --><?php //View('partials.search.inputs.location'); ?>
            <!--            </div>-->

            <div class="form-group">
                <?php View('partials.search.inputs.zip'); ?>
            </div>

            <div class="form-group">
                <?php View('partials.search.inputs.radius'); ?>
            </div>


            <!--				Advanced Search  (More Button) -->
            <div class="form-group" id="extra_fields" style="display:none">

                <div class="form-group">
                    <label class="control-label col-md-5" for="year">
                        <small>Year from</small>
                    </label>

                    <div class="control-field col-md-7">
                        <select name="year" class="form-control input-sm">
                            <option value="">Any</option>

                            <?php for ($year = date('Y') + 1; $year >= 1960; $year--) {
                                echo "<option>{$year}</option>";
                            } ?>

                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-5" for="doors">
                        <small>Doors</small>
                    </label>

                    <div class="control-field col-md-7">
                        <select name="doors" class="form-control input-sm">
                            <option value="">Any</option>

                            <?php for ($num_doors = 2; $num_doors <= 5; $num_doors++):
                                echo "<option>{$num_doors}</option>";
                            endfor ?>

                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-5" for="body_style">
                        <small>Body Style</small>
                    </label>

                    <?php $bodyStyles = \App\SearchWidget::getBodyStyles(); ?>
                    <div class="control-field col-md-7">
                        <select name="body_style" class="form-control input-sm">
                            <option value="">Any</option>

                            <?php $bodyStyles->map(function ($bodyStyle) {
                                echo "<option>{$bodyStyle}</option>";
                            }) ?>

                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-5" for="drivetrain">
                        <small>Drivetrain</small>
                    </label>

                    <div class="control-field col-md-7">
                        <select name="drivetrain" class="form-control input-sm">
                            <option value="">Any</option>

                            <option value="4WD">4WD</option>
                            <option value="AWD">AWD</option>
                            <option value="RWD">RWD</option>
                            <option value="FWD">FWD</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <?php View('partials.search.inputs.max_price'); ?>
                </div>

                <div class="form-group">
                    <?php View('partials.search.inputs.keyword'); ?>
                </div>


                <div class="form-group">
                    <?php View('partials.search.inputs.fuel_type'); ?>
                </div>


                <div class="form-group">
                    <?php View('partials.search.inputs.transmission'); ?>
                </div>


                <div class="form-group">
                    <?php View('partials.search.inputs.exterior_colors'); ?>
                </div>

                <div class="form-group">
                    <?php View('partials.search.inputs.mileage'); ?>
                </div>

                <br/>

                <!--                    --><?php //View('partials.search.inputs.features'); ?><!-- -->

                <div class="clearfix"></div>
                <div class="col-md-4">
                    <br/>
                    <input type="checkbox"
                           name="only_pictures" <?php if (isset($_REQUEST["only_pictures"])) echo "checked"; ?>
                           value="1"/>
                    show only listings with pictures
                </div>

            </div>

        </div><!--end form container-->
        <script>
            var less_text = "- Less";
            var more_text = "+ More";
        </script>
        <a hidden id="more_button" class="btn btn-default pull-left" href="javascript:AdvancedSearch()">+ More</a>

        <input class="btn btn-primary pull-right home-search-button shop4autos-green" type="submit" value="Search"/>

    </form>
    <div class="clear"></div>

    <!--END SEARCH FORM-->

</div>


<br/>

