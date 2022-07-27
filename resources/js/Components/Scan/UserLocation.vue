<template>
    <div class="mx-auto px-14">
        <div class="flex">
            <div class="flex w-5/12 mx-auto">
                <button @click="visible = true" type="submit" class="flex mt-5 items-center font-bold justify-center focus:outline-none text-white text-sm sm:text-base bg-bay-of-many-500 hover:bg-bay-of-many-600 rounded-2xl py-2 w-full transition duration-150 ease-in">
                    <span class="mr-2 uppercase">Manual Entry</span>
                </button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "UserLocation",
    data () {
        return {
            location: null,
            count: 0,
            error: null,
            scanning: false,
            watchID: null,
            loading: false,
            polling: null
        }
    },
    methods: {
        locate () {
            if (!this.scanning) {
                this.loading = true
                navigator.geolocation.getCurrentPosition(
                    (position) => {
                        this.scanning = true
                        this.location = {
                            lat: position.coords.latitude,
                            long: position.coords.longitude,
                            heading: position.coords.heading,
                            speed: position.coords.speed,
                            altitude: position.coords.altitude
                        }
                        this.$emit('location-updated', this.location)
                        this.loading = false
                        // Start watcher
                        this.watchID = navigator.geolocation.watchPosition(
                            (position) => {
                                this.location = {
                                    lat: position.coords.latitude,
                                    long: position.coords.longitude,
                                    heading: position.coords.heading,
                                    speed: position.coords.speed,
                                    altitude: position.coords.altitude
                                }
                                this.$emit('location-updated', this.location)
                            },
                            (error) => {
                                this.loading = false
                                this.error = error.message
                            }, { enableHighAccuracy: true, maximumAge: 0 }
                        )
                    },
                    (error) => {
                        this.error = error.message
                    }
                )
            } else {
                // Stop Scanning
                this.scanning = false
                navigator.geolocation.clearWatch(this.watchID)
                this.watchID = null
            }
        },
        getLocation () {
            navigator.geolocation.getCurrentPosition(
                (position) => {
                    this.location = {
                        lat: position.coords.latitude,
                        long: position.coords.longitude,
                        heading: position.coords.heading,
                        speed: position.coords.speed,
                        altitude: position.coords.altitude
                    }
                    this.$emit('location-updated', this.location)
                })
        },
        startPoll () {
            if (this.scanning) {
                this.scanning = false
                clearInterval(this.polling)
                this.polling = null
            } else {
                this.scanning = true
                this.polling = setInterval(() => {
                    this.getLocation()
                }, 1500)
            }
        }
    },
    beforeDestroy () {
        clearInterval(this.polling)
    }
}
</script>

<style scoped>

</style>
