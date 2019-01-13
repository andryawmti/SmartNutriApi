<script>
    new Vue({
        el: '#index-food-ingredient-wrapper',
        data() {
            return {
                food_ingredient_urts:[],
                item: {
                    urt_id: '',
                    urt_name: '',
                    quantity: 0,
                },
                show_urt_popup: false,
            }
        },
        methods: {
            showHidePickUrt() {
                this.show_urt_popup = !this.show_urt_popup;
            },
            pickUrt(urt) {
                urt = JSON.parse(urt);
                this.item.urt_id = urt.id;
                this.item.urt_name = urt.name;
                this.showHidePickUrt();
            },
            addItem() {
                if (!this.item.urt_id) {
                    return false;
                }
                this.food_ingredient_urts.push(_.cloneDeep(this.item));
                this.resetItem();
            },
            removeUrtItem(index) {
                this.food_ingredient_urts.splice(index, 1);
            },
            resetItem() {
                this.item.urt_id = '';
                this.item.urt_id = '';
                this.item.urt_name = '';
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