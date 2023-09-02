
<template>
    <div>
        <img class="user_logo" :src="$page.props.auth.user.avatar ">
        <p class="user_name_logo">{{ $page.props.auth.user.name }}</p>  
    </div>
</template>

