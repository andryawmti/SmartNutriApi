<script>
    new Vue({
        el: '#index-menu-wrapper',
        data() {
            return {
                menu_items:[],
                item: {
                    food_ingredient_id: '',
                    food_ingredient_name: '',
                    quantity: 0,
                },
                show_food_ingredient_popup: false,
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
                this.showHidePickFoodIngredient();
            },
            addItem() {
                if (!this.item.food_ingredient_id) {
                    return false;
                }
                this.menu_items.push(_.cloneDeep(this.item));
                this.resetItem();
            },
            removeItem(index) {
                this.menu_items.splice(index, 1);
            },
            resetItem() {
                this.item.food_ingredient_id = '';
                this.item.food_ingredient_name = '';
                this.item.quantity = 0;
            }
        },
        created(){
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