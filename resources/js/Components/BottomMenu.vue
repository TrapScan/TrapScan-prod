<template>
    <footer class="h-[70px] w-full mt-3
            fixed bottom-0
            flex justify-center items-center
           ">
        <div class="px-5 pt-3 w-full bg-white w-full dark:bg-mirage-500">
            <div class="flex flex-row space-x-6 justify-center items-center">
                <!-- Item #1 -->
                <div class="flex group">

                    <a href="#" class="p-1 montserrat" :class="{'text-niagara-500  dark:text-niagara-500': route().current('about'), ' text-bali-hai-500 font-bold': !route().current('about')}">
							<span class="flex flex-col items-center">
								<!-- Icon -->
								<svg :class="{'text-niagara-500  dark:text-white dark:bg-niagara-500': route().current('projects'),'text-bali-hai-500 hover:text-niagara-500 dark:hover:text-niagara-500': !route().current('projects')}" width="24" height="24" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" color="#000"><path d="M13 7.5a1 1 0 11-2 0 1 1 0 012 0zm-3 3.75a.75.75 0 01.75-.75h1.5a.75.75 0 01.75.75v4.25h.75a.75.75 0 010 1.5h-3a.75.75 0 010-1.5h.75V12h-.75a.75.75 0 01-.75-.75z"></path><path fill-rule="evenodd" d="M12 1C5.925 1 1 5.925 1 12s4.925 11 11 11 11-4.925 11-11S18.075 1 12 1zM2.5 12a9.5 9.5 0 1119 0 9.5 9.5 0 01-19 0z"></path></svg>
                                <!-- Text -->
								<span class="text-xs mb-2 transition-all duration-200">
									About
								</span>
							</span>
                    </a>
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
                                <svg :class="{'text-niagara-500  dark:text-white dark:bg-niagara-500': route().current('user.settings'),'text-bali-hai-500 font-bold hover:text-niagara-500 dark:hover:text-niagara-500': !route().current('user.settings')}"  width="24" height="24" viewBox="0 0 19 10" color="#000" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path d="M1.95334 7.855L1.86234 5.853L6.63334 0.899999H8.53134L4.56634 5.112L3.63034 6.139L1.95334 7.855ZM0.44534 10V0.899999H2.13534V10H0.44534ZM6.78934 10L3.30534 5.853L4.42334 4.618L8.76534 10H6.78934ZM10.566 10V0.899999H14.31C15.116 0.899999 15.805 1.03 16.377 1.29C16.9577 1.55 17.404 1.92267 17.716 2.408C18.028 2.89333 18.184 3.46967 18.184 4.137C18.184 4.80433 18.028 5.38067 17.716 5.866C17.404 6.35133 16.9577 6.724 16.377 6.984C15.805 7.244 15.116 7.374 14.31 7.374H11.502L12.256 6.581V10H10.566ZM12.256 6.763L11.502 5.944H14.232C14.9774 5.944 15.5364 5.788 15.909 5.476C16.2904 5.15533 16.481 4.709 16.481 4.137C16.481 3.55633 16.2904 3.11 15.909 2.798C15.5364 2.486 14.9774 2.33 14.232 2.33H11.502L12.256 1.498V6.763Z"/>
                                </svg>

                                <!-- Text -->
								<span class="text-xs mb-2 transition-all duration-200">
									Settings
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
