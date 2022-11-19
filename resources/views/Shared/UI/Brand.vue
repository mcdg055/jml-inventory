<template>
    <div class="max-h-[100px] w-full mx-auto block">
        <img :src="logo" alt="System Brand" class="max-h-[100px] w-full object-contain block">
    </div>
</template>

<script>

const logo = "../../../../storage/images/JML-LOGO--TRANSPARENT.png";

export default {
    data() {
        return {
            logo: logo,
        }
    }
}

</script>