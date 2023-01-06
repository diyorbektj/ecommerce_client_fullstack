<template>
    <main class="max-w-screen-xl mx-auto bg-white w-full h-auto m-8 p-8 rounded-md">
        <div class="flex justify-center items-center my-4">
            <div class="bg-green-200 h-44 w-44 rounded-full">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="text-green-800 w-[11rem] h-[11rem]">
                    <path fill-rule="evenodd" d="M19.916 4.626a.75.75 0 01.208 1.04l-9 13.5a.75.75 0 01-1.154.114l-6-6a.75.75 0 011.06-1.06l5.353 5.353 8.493-12.739a.75.75 0 011.04-.208z" clip-rule="evenodd" />
                </svg>
            <div class="my-2">Успешно оформлено</div>
                <div class="m-4 text-xl">{{ list }}</div>
            </div>
        </div>
    </main>
</template>

<script>
export default {
    name: "Successfully",
    computed: {
        timeLeft() {
            return 20 - 1
        }
    },
    data () {
        return {
            list: "salom",
            timer: ''
        }
    },
    created() {
        this.fetchEventsList();
        this.timer = setInterval(this.fetchEventsList, 100);
    },
    methods: {
        fetchEventsList () {
            this.list = "test"
        },
        cancelAutoUpdate () {
            clearInterval(this.timer);
        }
    }
}
</script>

<style scoped>

</style>
