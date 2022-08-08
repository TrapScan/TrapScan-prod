<template>
    <footer class="h-[70px] w-full mt-3
            fixed bottom-0
            flex justify-center items-center
           ">
        <div class="px-5 pt-3 w-full bg-white w-full dark:bg-mirage-500">
            <div class="flex flex-row space-x-6 justify-center items-center">
                <!-- Item #1 -->
                <div class="flex group">

                    <Link :href="route('about')" class="p-1 montserrat" :class="{'text-niagara-500 font-bold dark:text-niagara-500': route().current('about'), ' text-bali-hai-500 font-bold': !route().current('about')}">
							<span class="flex flex-col items-center">
								<!-- Icon -->
								<svg :class="{'text-niagara-500  dark:text-white dark:bg-niagara-500': route().current('projects'),'text-bali-hai-500 hover:text-niagara-500 dark:hover:text-niagara-500': !route().current('projects')}" width="24" height="24" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" color="#000"><path d="M13 7.5a1 1 0 11-2 0 1 1 0 012 0zm-3 3.75a.75.75 0 01.75-.75h1.5a.75.75 0 01.75.75v4.25h.75a.75.75 0 010 1.5h-3a.75.75 0 010-1.5h.75V12h-.75a.75.75 0 01-.75-.75z"></path><path fill-rule="evenodd" d="M12 1C5.925 1 1 5.925 1 12s4.925 11 11 11 11-4.925 11-11S18.075 1 12 1zM2.5 12a9.5 9.5 0 1119 0 9.5 9.5 0 01-19 0z"></path></svg>
                                <!-- Text -->
								<span class="text-xs mb-2 transition-all duration-200">
									About
								</span>
							</span>
                    </Link>
                </div>

                <!-- Item #2 -->
                <div class="flex group">
                    <Link :href="route('user.index')" class="p-1 montserrat" :class="{'text-niagara-500 font-bold dark:text-niagara-500': route().current('user.index'), ' text-bali-hai-500 font-bold': !route().current('user.index')}">
					    <span class="flex flex-col items-center">
								<!-- Icon -->
                            <svg :class="{'text-niagara-500  dark:text-white dark:bg-niagara-500': route().current('user.index'),'text-bali-hai-500 hover:text-niagara-500 dark:hover:text-niagara-500': !route().current('user.index')}" width="24" height="24" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" color="#000"><path d="M2.5 2.75a.75.75 0 00-1.5 0v18.5c0 .414.336.75.75.75H20a.75.75 0 000-1.5H2.5V2.75z"></path><path d="M22.28 7.78a.75.75 0 00-1.06-1.06l-5.72 5.72-3.72-3.72a.75.75 0 00-1.06 0l-6 6a.75.75 0 101.06 1.06l5.47-5.47 3.72 3.72a.75.75 0 001.06 0l6.25-6.25z"></path></svg>
                        <!-- Text -->
                            <span class="text-xs mb-2 transition-all duration-200">
                                Data
                            </span>
                        </span>
                    </Link>

                </div>

                <!-- Item #3 Active -->
                <div class="flex group">
                    <Link :href="route('scan')" class="p-1 montserrat" :class="{'text-niagara-500 font-bold dark:text-niagara-500': route().current('scan'), ' text-bali-hai-500 font-bold': !route().current('scan')}">
                        		<span class="flex flex-col items-center">
								<!-- Icon -->
								<svg width="24"  :class="{'text-niagara-500  dark:text-white dark:bg-niagara-500': route().current('scan'),'text-bali-hai-500 hover:text-niagara-500 dark:hover:text-niagara-500': !route().current('scan')}" height="24" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" color="#000"><path fill="none" d="M0 0h24v24H0z"></path><path d="M9.5 6.5v3h-3v-3h3M11 5H5v6h6V5zm-1.5 9.5v3h-3v-3h3M11 13H5v6h6v-6zm6.5-6.5v3h-3v-3h3M19 5h-6v6h6V5zm-6 8h1.5v1.5H13V13zm1.5 1.5H16V16h-1.5v-1.5zM16 13h1.5v1.5H16V13zm-3 3h1.5v1.5H13V16zm1.5 1.5H16V19h-1.5v-1.5zM16 16h1.5v1.5H16V16zm1.5-1.5H19V16h-1.5v-1.5zm0 3H19V19h-1.5v-1.5zM22 7h-2V4h-3V2h5v5zm0 15v-5h-2v3h-3v2h5zM2 22h5v-2H4v-3H2v5zM2 2v5h2V4h3V2H2z"></path></svg>

                                    <!-- Text -->
								<span class="text-xs mb-2 transition-all duration-200">
									Scan
								</span>
							</span>
                    </Link>
                </div>

                <!-- Item #4 -->
                <div class="flex group ">
                    <Link :href="route('user.projects')" class="p-1 montserrat" :class="{'text-niagara-500 font-bold dark:text-niagara-500': route().current('user.projects'), 'text-bali-hai-500 font-bold': !route().current('user.projects')}">
							<span class="flex flex-col items-center">
								<!-- Icon -->
                                <svg :class="{'text-niagara-500  dark:text-white dark:bg-niagara-500': route().current('user.projects'),'text-bali-hai-500 hover:text-niagara-500 dark:hover:text-niagara-500': !route().current('user.projects')}" width="24" height="24" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path d="M16 5.64801C16 2.52547 13.5171 0 10.4472 0C7.37729 0 4.8944 2.52547 4.8944 5.64801C4.89339 6.98156 5.35764 8.27221 6.20451 9.29022C7.05139 10.3082 8.22593 10.9876 9.51909 11.2073V14.3863H3.17303V11.9657H3.96629V8.73828C3.96629 8.2945 3.60932 7.93142 3.17303 7.93142H0.793257C0.356966 7.93142 0 8.2945 0 8.73828V11.9657H0.793257V16H13.4854V14.3863H11.1056V11.2557C12.4546 11.0918 13.6978 10.4306 14.5997 9.3972C15.5017 8.36379 15.9999 7.0299 16 5.64801ZM1.98314 7.12456C2.64155 7.12456 3.17303 6.58396 3.17303 5.91427C3.17303 5.24458 2.64155 4.70398 1.98314 4.70398C1.32474 4.70398 0.793257 5.24458 0.793257 5.91427C0.793257 6.58396 1.32474 7.12456 1.98314 7.12456Z" fill="#849DAE"/>
                                </svg>

                                <!-- Text -->
								<span class="text-xs mb-2 transition-all duration-200">
									Project
								</span>
							</span>
                    </Link>
                </div>

                <!-- Item #5 -->
                <div class="flex group">
                    <Link :href="route('user.settings')" class="p-1 montserrat" :class="{'text-niagara-500 font-bold dark:text-niagara-500': route().current('user.settings'), 'text-bali-hai-500 font-bold': !route().current('user.settings')}">
							<span class="flex flex-col items-center">
								<!-- Icon -->
                                <svg :class="{'text-niagara-500  dark:text-white dark:bg-niagara-500': route().current('user.settings'),'text-bali-hai-500 font-bold hover:text-niagara-500 dark:hover:text-niagara-500': !route().current('user.settings')}" width="29" height="28" viewBox="0 0 29 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_1874_3770)">
                                    <path d="M15.0369 8.33008C16.0496 8.33008 16.8706 7.50909 16.8706 6.49634C16.8706 5.48359 16.0496 4.6626 15.0369 4.6626C14.0241 4.6626 13.2031 5.48359 13.2031 6.49634C13.2031 7.50909 14.0241 8.33008 15.0369 8.33008Z" fill="#849DAE"/>
                                    <path d="M18.6028 10.2647C18.2452 9.9071 17.6309 9.24695 16.4389 9.24695H14.1101C11.5887 9.23778 9.53491 7.18399 9.53491 4.6626H7.70117C7.70117 7.55991 9.63577 10.0171 12.2855 10.8148L12.2855 23H14.1193L14.1193 17.4988H15.953V23H17.7867V12.0434L21.4084 15.665L22.7012 14.3723L18.6028 10.2647Z" fill="#849DAE"/>
                                    </g>
                                    <defs>
                                    <clipPath id="clip0_1874_3770">
                                    <rect width="28" height="28" fill="white" transform="translate(0.701172)"/>
                                    </clipPath>
                                    </defs>
                                </svg>

                                <!-- Text -->
								<span class="text-xs mb-2 transition-all duration-200">
									Me
								</span>
							</span>
                    </Link>
                </div>
            </div>
        </div>
    </footer>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3'

export default {
    components:{
        Link
    },
    name: "BottomMenu"
}
</script>
