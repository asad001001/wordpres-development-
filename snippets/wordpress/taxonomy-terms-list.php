
                  <?php
    /** The taxonomy we want to parse */
    $taxonomy = "category";
    /** Get all taxonomy terms */
    $terms = get_terms($taxonomy, array(
            "orderby"    => "count",
            "hide_empty" => false
        )
    );
    /** Get terms that have children */
    $hierarchy = _get_term_hierarchy($taxonomy);
    ?>
    <select name="terms" id="terms">
        <?php
            /** Loop through every term */
            foreach($terms as $term) {
                /** Skip term if it has children */
                if($term->parent) {
                    continue;
                }
                echo '<option value="' . $term->name . '">' . $term->name . '</option>';
                /** If the term has children... */
                if($hierarchy[$term->term_id]) {
                    /** ...display them */
                    foreach($hierarchy[$term->term_id] as $child) {
                        /** Get the term object by its ID */
                        $child = get_term($child, "category");
                        echo '<option class="sss" value="' . $term->name . '"> - ' . $child->name . '</option>';
                            if($hierarchy[$child->term_id]) {
                            /** ...display them */
                            foreach($hierarchy[$child->term_id] as $child2) {
                                /** Get the term object by its ID */
                                $child2 = get_term($child2, "category");
                                echo '<option class="ee" value="' . $child2->name . '"> - ' . $child2->name . '</option>';
                            }
                        }
                    }
                }
            }
        ?>
    </select>
