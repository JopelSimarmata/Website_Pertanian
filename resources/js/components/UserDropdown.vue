<template>
  <div class="relative ml-3">
    <el-dropdown>
      <button
        class="relative flex rounded-full focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500"
      >
        <img
          :src="photo"
          :alt="name"
          class="h-8 w-8 rounded-full object-cover"
        />
      </button>

      <template #dropdown>
        <el-dropdown-menu class="w-48">
          <el-dropdown-item>
            <a href="#" class="block px-4 py-2 text-sm text-gray-700">Profile</a>
          </el-dropdown-item>

          <el-dropdown-item>
            <a href="#" class="block px-4 py-2 text-sm text-gray-700">Settings</a>
          </el-dropdown-item>

          <el-dropdown-item divided>
            <form method="POST" action="/logout">
              <button type="submit" class="w-full text-left block px-4 py-2 text-sm text-gray-700">
                Keluar
              </button>
            </form>
          </el-dropdown-item>
        </el-dropdown-menu>
      </template>
    </el-dropdown>
  </div>
</template>

<script setup>
defineProps({
  name: String,
  photo: String,
});
</script>
