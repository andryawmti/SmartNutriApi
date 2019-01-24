<script>
    new Vue({
        el: '#edit-menu-wrapper',
        data() {
            return {
                menu_items:{!! json_encode($menu_items) !!},
                item: {
                    food_ingredient_id: '',
                    food_ingredient_name: '',
                    calorie: 0,
                    quantity: 0,
                },
                total_calorie: 0,
                show_food_ingredient_popup: false,
                food_ingredient_url: '{!! url('food-ingredient') !!}',
            }
        },
        methods: {
            showHidePickFoodIngredient() {
                this.show_food_ingredient_popup = !this.show_food_ingredient_popup;
            },
            pickFoodIngredient(ingredient) {
                ingredient = JSON.parse(ingredient);
                this.item.food_ingredient_id = ingredient.id;
                this.item.food_ingredient_name = ingredient.name;
                this.item.calorie = ingredient.calorie;
                this.showHidePickFoodIngredient();
            },
            addItem() {
                if (!this.item.food_ingredient_id) {
                    return false;
                }
                this.menu_items.push(_.cloneDeep(this.item));
                this.calculateTotalCalorie();
                this.resetItem();
            },
            removeItem(index) {
                this.menu_items.splice(index, 1);
            },
            resetItem() {
                this.item.food_ingredient_id = '';
                this.item.food_ingredient_name = '';
                this.item.calorie = 0;
                this.item.quantity = 0;
            },
            calculateTotalCalorie() {
                let calorie = 0;
                this.menu_items.forEach(function (item) {
                    calorie += parseInt(item.calorie);
                });
                this.total_calorie = calorie;
            },
        },
        created(){
            this.calculateTotalCalorie();
        }
    });
</script>
<style>
    .my-popup {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background: #ffffff;
        padding: 10px;
        box-shadow: 0px 0px 4px 2px #6c757d;
    }

    .my-popup-show {
        display: block;
    }

    .my-popup-hide {
        display: none;
    }
</style>