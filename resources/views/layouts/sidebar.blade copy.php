<div
	class="sidebar dark:bg-coal-600 bg-light border-r border-r-gray-200 dark:border-r-coal-100 fixed top-0 bottom-0 z-20 hidden lg:flex flex-col items-stretch shrink-0"
	data-drawer="true" data-drawer-class="drawer drawer-start top-0 bottom-0" data-drawer-enable="true|lg:false"
	id="sidebar">
	<div class="sidebar-header hidden lg:flex items-center relative justify-between px-3 lg:px-6 shrink-0"
		id="sidebar_header">
		<a class="dark:hidden" href="html/demo1.html">
			<img class="default-logo min-h-[22px] max-w-none" src="assets/media/app/vtnet-150.png" />
			<img class="small-logo min-h-[22px] max-w-none" src="assets/media/app/mini-logo-50x50.png" />
		</a>
		<a class="hidden dark:block" href="html/demo1.html">
			<img class="default-logo min-h-[22px] max-w-none" src="assets/media/app/default-logo-dark.svg" />
			<img class="small-logo min-h-[22px] max-w-none" src="assets/media/app/mini-logo-50x50.png" />
		</a>
		<button
			class="btn btn-icon btn-icon-md size-[30px] rounded-lg border border-gray-200 dark:border-gray-300 bg-light text-gray-500 hover:text-gray-700 toggle absolute left-full top-2/4 -translate-x-2/4 -translate-y-2/4"
			data-toggle="body" data-toggle-class="sidebar-collapse" id="sidebar_toggle">
			<i class="ki-filled ki-black-left-line toggle-active:rotate-180 transition-all duration-300">
			</i>
		</button>
	</div>
	<div class="sidebar-content flex grow shrink-0 py-5 pr-2" id="sidebar_content">
		<div class="scrollable-y-hover grow shrink-0 flex pl-2 lg:pl-5 pr-1 lg:pr-3" data-scrollable="true"
			data-scrollable-dependencies="#sidebar_header" data-scrollable-height="auto" data-scrollable-offset="0px"
			data-scrollable-wrappers="#sidebar_content" id="sidebar_scrollable">
			<div class="menu flex flex-col grow gap-0.5" data-menu="true" data-menu-accordion-expand-all="false"
				id="sidebar_menu">
				<div class="menu-item" data-menu-item-toggle="accordion" data-menu-item-trigger="click">
					<div
						class="menu-link flex items-center grow cursor-pointer border border-transparent gap-[10px] pl-[10px] pr-[10px] py-[6px]"
						tabindex="0">
						<span class="menu-icon items-start text-gray-500 dark:text-gray-400 w-[20px]">
							<i class="ki-filled ki-element-11 text-lg">
							</i>
						</span>
						<span
							class="menu-title text-sm font-semibold text-gray-700 menu-item-active:text-primary menu-link-hover:!text-primary">
							Dashboards
						</span>
						<span class="menu-arrow text-gray-400 w-[20px] shrink-0 justify-end ml-1 mr-[-10px]">
							<i class="ki-filled ki-plus text-2xs menu-item-show:hidden">
							</i>
							<i class="ki-filled ki-minus text-2xs hidden menu-item-show:inline-flex">
							</i>
						</span>
					</div>
					<div
						class="menu-accordion gap-0.5 pl-[10px] relative before:absolute before:left-[20px] before:top-0 before:bottom-0 before:border-l before:border-gray-200">
						<div class="menu-item">
							<a class="menu-link gap-[14px] pl-[10px] pr-[10px] py-[8px] border border-transparent items-center grow menu-item-active:bg-secondary-active dark:menu-item-active:bg-coal-300 dark:menu-item-active:border-gray-100 menu-item-active:rounded-lg hover:bg-secondary-active dark:hover:bg-coal-300 dark:hover:border-gray-100 hover:rounded-lg"
								href="html/demo1.html" tabindex="0">
								<span
									class="menu-bullet flex w-[6px] relative before:absolute before:top-0 before:size-[6px] before:rounded-full before:-translate-x-1/2 before:-translate-y-1/2 menu-item-active:before:bg-primary menu-item-hover:before:bg-primary">
								</span>
								<span
									class="menu-title text-2sm font-medium text-gray-700 menu-item-active:text-primary menu-item-active:font-semibold menu-link-hover:!text-primary">
									Light Sidebar
								</span>
							</a>
						</div>
						<div class="menu-item">
							<a class="menu-link gap-[14px] pl-[10px] pr-[10px] py-[8px] border border-transparent items-center grow menu-item-active:bg-secondary-active dark:menu-item-active:bg-coal-300 dark:menu-item-active:border-gray-100 menu-item-active:rounded-lg hover:bg-secondary-active dark:hover:bg-coal-300 dark:hover:border-gray-100 hover:rounded-lg"
								href="html/demo1/dashboards/dark-sidebar.html" tabindex="0">
								<span
									class="menu-bullet flex w-[6px] relative before:absolute before:top-0 before:size-[6px] before:rounded-full before:-translate-x-1/2 before:-translate-y-1/2 menu-item-active:before:bg-primary menu-item-hover:before:bg-primary">
								</span>
								<span
									class="menu-title text-2sm font-medium text-gray-700 menu-item-active:text-primary menu-item-active:font-semibold menu-link-hover:!text-primary">
									Dark Sidebar
								</span>
							</a>
						</div>
					</div>
				</div>
				<div class="menu-item pt-2.25 pb-px">
					<span class="menu-heading uppercase pl-[10px] pr-[10px] text-2sm font-semibold text-gray-500">
						HRD
					</span>
				</div>
				<div class="menu-item" data-menu-item-toggle="accordion" data-menu-item-trigger="click">
					<div
						class="menu-link flex items-center grow cursor-pointer border border-transparent gap-[10px] pl-[10px] pr-[10px] py-[6px]"
						tabindex="0">
						<span class="menu-icon items-start text-gray-500 dark:text-gray-400 w-[20px]">
							<i class="ki-filled ki-users text-lg">
							</i>
						</span>
						<span
							class="menu-title text-sm font-semibold text-gray-700 menu-item-active:text-primary menu-link-hover:!text-primary">
							Karyawan
						</span>
						<span class="menu-arrow text-gray-400 w-[20px] shrink-0 justify-end ml-1 mr-[-10px]">
							<i class="ki-filled ki-plus text-2xs menu-item-show:hidden">
							</i>
							<i class="ki-filled ki-minus text-2xs hidden menu-item-show:inline-flex">
							</i>
						</span>
					</div>
					<div
						class="menu-accordion gap-0.5 pl-[10px] relative before:absolute before:left-[20px] before:top-0 before:bottom-0 before:border-l before:border-gray-200">
						<div class="menu-item">
							<a class="menu-link gap-[14px] pl-[10px] pr-[10px] py-[8px] border border-transparent items-center grow menu-item-active:bg-secondary-active dark:menu-item-active:bg-coal-300 dark:menu-item-active:border-gray-100 menu-item-active:rounded-lg hover:bg-secondary-active dark:hover:bg-coal-300 dark:hover:border-gray-100 hover:rounded-lg"
								href="html/demo1/network/get-started.html" tabindex="0">
								<span
									class="menu-bullet flex w-[6px] relative before:absolute before:top-0 before:size-[6px] before:rounded-full before:-translate-x-1/2 before:-translate-y-1/2 menu-item-active:before:bg-primary menu-item-hover:before:bg-primary">
								</span>
								<span
									class="menu-title text-2sm font-medium text-gray-700 menu-item-active:text-primary menu-item-active:font-semibold menu-link-hover:!text-primary">
									Get Started
								</span>
							</a>
						</div>
						<div class="menu-item" data-menu-item-toggle="accordion" data-menu-item-trigger="click">
							<div
								class="menu-link border border-transparent gap-[14px] pl-[10px] pr-[10px] py-[8px] grow cursor-pointer"
								tabindex="0">
								<span
									class="menu-bullet flex w-[6px] relative before:absolute before:top-0 before:size-[6px] before:rounded-full before:-translate-x-1/2 before:-translate-y-1/2 menu-item-active:before:bg-primary menu-item-hover:before:bg-primary">
								</span>
								<span
									class="menu-title text-2sm font-medium mr-1 text-gray-700 menu-item-active:text-primary menu-item-active:font-semibold menu-link-hover:!text-primary">
									User Cards
								</span>
								<span class="menu-arrow text-gray-400 w-[20px] shrink-0 justify-end ml-1 mr-[-10px]">
									<i class="ki-filled ki-plus text-2xs menu-item-show:hidden">
									</i>
									<i class="ki-filled ki-minus text-2xs hidden menu-item-show:inline-flex">
									</i>
								</span>
							</div>
							<div
								class="menu-accordion gap-0.5 relative before:absolute before:left-[32px] pl-[22px] before:top-0 before:bottom-0 before:border-l before:border-gray-200">
								<div class="menu-item">
									<a class="menu-link gap-[5px] pl-[10px] pr-[10px] py-[8px] border border-transparent items-center grow menu-item-active:bg-secondary-active dark:menu-item-active:bg-coal-300 dark:menu-item-active:border-gray-100 menu-item-active:rounded-lg hover:bg-secondary-active dark:hover:bg-coal-300 dark:hover:border-gray-100 hover:rounded-lg"
										href="html/demo1/network/user-cards/mini-cards.html" tabindex="0">
										<span
											class="menu-bullet flex w-[6px] relative before:absolute before:top-0 before:size-[6px] before:rounded-full before:-translate-x-1/2 before:-translate-y-1/2 menu-item-active:before:bg-primary menu-item-hover:before:bg-primary">
										</span>
										<span
											class="menu-title text-2sm font-medium text-gray-700 menu-item-active:text-primary menu-item-active:font-semibold menu-link-hover:!text-primary">
											Mini Cards
										</span>
									</a>
								</div>
								<div class="menu-item">
									<a class="menu-link gap-[5px] pl-[10px] pr-[10px] py-[8px] border border-transparent items-center grow menu-item-active:bg-secondary-active dark:menu-item-active:bg-coal-300 dark:menu-item-active:border-gray-100 menu-item-active:rounded-lg hover:bg-secondary-active dark:hover:bg-coal-300 dark:hover:border-gray-100 hover:rounded-lg"
										href="html/demo1/network/user-cards/team-crew.html" tabindex="0">
										<span
											class="menu-bullet flex w-[6px] relative before:absolute before:top-0 before:size-[6px] before:rounded-full before:-translate-x-1/2 before:-translate-y-1/2 menu-item-active:before:bg-primary menu-item-hover:before:bg-primary">
										</span>
										<span
											class="menu-title text-2sm font-medium text-gray-700 menu-item-active:text-primary menu-item-active:font-semibold menu-link-hover:!text-primary">
											Team Crew
										</span>
									</a>
								</div>
								<div class="menu-item">
									<a class="menu-link gap-[5px] pl-[10px] pr-[10px] py-[8px] border border-transparent items-center grow menu-item-active:bg-secondary-active dark:menu-item-active:bg-coal-300 dark:menu-item-active:border-gray-100 menu-item-active:rounded-lg hover:bg-secondary-active dark:hover:bg-coal-300 dark:hover:border-gray-100 hover:rounded-lg"
										href="html/demo1/network/user-cards/author.html" tabindex="0">
										<span
											class="menu-bullet flex w-[6px] relative before:absolute before:top-0 before:size-[6px] before:rounded-full before:-translate-x-1/2 before:-translate-y-1/2 menu-item-active:before:bg-primary menu-item-hover:before:bg-primary">
										</span>
										<span
											class="menu-title text-2sm font-medium text-gray-700 menu-item-active:text-primary menu-item-active:font-semibold menu-link-hover:!text-primary">
											Author
										</span>
									</a>
								</div>
								<div class="menu-item">
									<a class="menu-link gap-[5px] pl-[10px] pr-[10px] py-[8px] border border-transparent items-center grow menu-item-active:bg-secondary-active dark:menu-item-active:bg-coal-300 dark:menu-item-active:border-gray-100 menu-item-active:rounded-lg hover:bg-secondary-active dark:hover:bg-coal-300 dark:hover:border-gray-100 hover:rounded-lg"
										href="html/demo1/network/user-cards/nft.html" tabindex="0">
										<span
											class="menu-bullet flex w-[6px] relative before:absolute before:top-0 before:size-[6px] before:rounded-full before:-translate-x-1/2 before:-translate-y-1/2 menu-item-active:before:bg-primary menu-item-hover:before:bg-primary">
										</span>
										<span
											class="menu-title text-2sm font-medium text-gray-700 menu-item-active:text-primary menu-item-active:font-semibold menu-link-hover:!text-primary">
											NFT
										</span>
									</a>
								</div>
								<div class="menu-item">
									<a class="menu-link gap-[5px] pl-[10px] pr-[10px] py-[8px] border border-transparent items-center grow menu-item-active:bg-secondary-active dark:menu-item-active:bg-coal-300 dark:menu-item-active:border-gray-100 menu-item-active:rounded-lg hover:bg-secondary-active dark:hover:bg-coal-300 dark:hover:border-gray-100 hover:rounded-lg"
										href="html/demo1/network/user-cards/social.html" tabindex="0">
										<span
											class="menu-bullet flex w-[6px] relative before:absolute before:top-0 before:size-[6px] before:rounded-full before:-translate-x-1/2 before:-translate-y-1/2 menu-item-active:before:bg-primary menu-item-hover:before:bg-primary">
										</span>
										<span
											class="menu-title text-2sm font-medium text-gray-700 menu-item-active:text-primary menu-item-active:font-semibold menu-link-hover:!text-primary">
											Social
										</span>
									</a>
								</div>
							</div>
						</div>
						<div class="menu-item" data-menu-item-toggle="accordion" data-menu-item-trigger="click">
							<div
								class="menu-link border border-transparent gap-[14px] pl-[10px] pr-[10px] py-[8px] grow cursor-pointer"
								tabindex="0">
								<span
									class="menu-bullet flex w-[6px] relative before:absolute before:top-0 before:size-[6px] before:rounded-full before:-translate-x-1/2 before:-translate-y-1/2 menu-item-active:before:bg-primary menu-item-hover:before:bg-primary">
								</span>
								<span
									class="menu-title text-2sm font-medium mr-1 text-gray-700 menu-item-active:text-primary menu-item-active:font-semibold menu-link-hover:!text-primary">
									User Table
								</span>
								<span class="menu-arrow text-gray-400 w-[20px] shrink-0 justify-end ml-1 mr-[-10px]">
									<i class="ki-filled ki-plus text-2xs menu-item-show:hidden">
									</i>
									<i class="ki-filled ki-minus text-2xs hidden menu-item-show:inline-flex">
									</i>
								</span>
							</div>
							<div
								class="menu-accordion gap-0.5 relative before:absolute before:left-[32px] pl-[22px] before:top-0 before:bottom-0 before:border-l before:border-gray-200">
								<div class="menu-item">
									<a class="menu-link gap-[5px] pl-[10px] pr-[10px] py-[8px] border border-transparent items-center grow menu-item-active:bg-secondary-active dark:menu-item-active:bg-coal-300 dark:menu-item-active:border-gray-100 menu-item-active:rounded-lg hover:bg-secondary-active dark:hover:bg-coal-300 dark:hover:border-gray-100 hover:rounded-lg"
										href="html/demo1/network/user-table/team-crew.html" tabindex="0">
										<span
											class="menu-bullet flex w-[6px] relative before:absolute before:top-0 before:size-[6px] before:rounded-full before:-translate-x-1/2 before:-translate-y-1/2 menu-item-active:before:bg-primary menu-item-hover:before:bg-primary">
										</span>
										<span
											class="menu-title text-2sm font-medium text-gray-700 menu-item-active:text-primary menu-item-active:font-semibold menu-link-hover:!text-primary">
											Team Crew
										</span>
									</a>
								</div>
								<div class="menu-item">
									<a class="menu-link gap-[5px] pl-[10px] pr-[10px] py-[8px] border border-transparent items-center grow menu-item-active:bg-secondary-active dark:menu-item-active:bg-coal-300 dark:menu-item-active:border-gray-100 menu-item-active:rounded-lg hover:bg-secondary-active dark:hover:bg-coal-300 dark:hover:border-gray-100 hover:rounded-lg"
										href="html/demo1/network/user-table/app-roster.html" tabindex="0">
										<span
											class="menu-bullet flex w-[6px] relative before:absolute before:top-0 before:size-[6px] before:rounded-full before:-translate-x-1/2 before:-translate-y-1/2 menu-item-active:before:bg-primary menu-item-hover:before:bg-primary">
										</span>
										<span
											class="menu-title text-2sm font-medium text-gray-700 menu-item-active:text-primary menu-item-active:font-semibold menu-link-hover:!text-primary">
											App Roster
										</span>
									</a>
								</div>
								<div class="menu-item">
									<a class="menu-link gap-[5px] pl-[10px] pr-[10px] py-[8px] border border-transparent items-center grow menu-item-active:bg-secondary-active dark:menu-item-active:bg-coal-300 dark:menu-item-active:border-gray-100 menu-item-active:rounded-lg hover:bg-secondary-active dark:hover:bg-coal-300 dark:hover:border-gray-100 hover:rounded-lg"
										href="html/demo1/network/user-table/market-authors.html" tabindex="0">
										<span
											class="menu-bullet flex w-[6px] relative before:absolute before:top-0 before:size-[6px] before:rounded-full before:-translate-x-1/2 before:-translate-y-1/2 menu-item-active:before:bg-primary menu-item-hover:before:bg-primary">
										</span>
										<span
											class="menu-title text-2sm font-medium text-gray-700 menu-item-active:text-primary menu-item-active:font-semibold menu-link-hover:!text-primary">
											Market Authors
										</span>
									</a>
								</div>
								<div class="menu-item">
									<a class="menu-link gap-[5px] pl-[10px] pr-[10px] py-[8px] border border-transparent items-center grow menu-item-active:bg-secondary-active dark:menu-item-active:bg-coal-300 dark:menu-item-active:border-gray-100 menu-item-active:rounded-lg hover:bg-secondary-active dark:hover:bg-coal-300 dark:hover:border-gray-100 hover:rounded-lg"
										href="html/demo1/network/user-table/saas-users.html" tabindex="0">
										<span
											class="menu-bullet flex w-[6px] relative before:absolute before:top-0 before:size-[6px] before:rounded-full before:-translate-x-1/2 before:-translate-y-1/2 menu-item-active:before:bg-primary menu-item-hover:before:bg-primary">
										</span>
										<span
											class="menu-title text-2sm font-medium text-gray-700 menu-item-active:text-primary menu-item-active:font-semibold menu-link-hover:!text-primary">
											SaaS Users
										</span>
									</a>
								</div>
								<div class="menu-item">
									<a class="menu-link gap-[5px] pl-[10px] pr-[10px] py-[8px] border border-transparent items-center grow menu-item-active:bg-secondary-active dark:menu-item-active:bg-coal-300 dark:menu-item-active:border-gray-100 menu-item-active:rounded-lg hover:bg-secondary-active dark:hover:bg-coal-300 dark:hover:border-gray-100 hover:rounded-lg"
										href="html/demo1/network/user-table/store-clients.html" tabindex="0">
										<span
											class="menu-bullet flex w-[6px] relative before:absolute before:top-0 before:size-[6px] before:rounded-full before:-translate-x-1/2 before:-translate-y-1/2 menu-item-active:before:bg-primary menu-item-hover:before:bg-primary">
										</span>
										<span
											class="menu-title text-2sm font-medium text-gray-700 menu-item-active:text-primary menu-item-active:font-semibold menu-link-hover:!text-primary">
											Store Clients
										</span>
									</a>
								</div>
								<div class="menu-item">
									<a class="menu-link gap-[5px] pl-[10px] pr-[10px] py-[8px] border border-transparent items-center grow menu-item-active:bg-secondary-active dark:menu-item-active:bg-coal-300 dark:menu-item-active:border-gray-100 menu-item-active:rounded-lg hover:bg-secondary-active dark:hover:bg-coal-300 dark:hover:border-gray-100 hover:rounded-lg"
										href="html/demo1/network/user-table/visitors.html" tabindex="0">
										<span
											class="menu-bullet flex w-[6px] relative before:absolute before:top-0 before:size-[6px] before:rounded-full before:-translate-x-1/2 before:-translate-y-1/2 menu-item-active:before:bg-primary menu-item-hover:before:bg-primary">
										</span>
										<span
											class="menu-title text-2sm font-medium text-gray-700 menu-item-active:text-primary menu-item-active:font-semibold menu-link-hover:!text-primary">
											Visitors
										</span>
									</a>
								</div>
							</div>
						</div>
						<div class="menu-item">
							<div
								class="menu-label gap-[14px] pl-[10px] pr-[10px] py-[8px] border border-transparent items-center grow"
								href="#" tabindex="0">
								<span
									class="menu-bullet flex w-[6px] relative before:absolute before:top-0 before:size-[6px] before:rounded-full before:-translate-x-1/2 before:-translate-y-1/2 menu-item-active:before:bg-primary menu-item-hover:before:bg-primary">
								</span>
								<span class="menu-title text-2sm font-medium text-gray-700">
									Cooperations
								</span>
								<span class="menu-badge mr-[-10px]">
									<span class="badge badge-xs">
										Soon
									</span>
								</span>
							</div>
						</div>
						<div class="menu-item">
							<div
								class="menu-label gap-[14px] pl-[10px] pr-[10px] py-[8px] border border-transparent items-center grow"
								href="#" tabindex="0">
								<span
									class="menu-bullet flex w-[6px] relative before:absolute before:top-0 before:size-[6px] before:rounded-full before:-translate-x-1/2 before:-translate-y-1/2 menu-item-active:before:bg-primary menu-item-hover:before:bg-primary">
								</span>
								<span class="menu-title text-2sm font-medium text-gray-700">
									Leads
								</span>
								<span class="menu-badge mr-[-10px]">
									<span class="badge badge-xs">
										Soon
									</span>
								</span>
							</div>
						</div>
						<div class="menu-item">
							<div
								class="menu-label gap-[14px] pl-[10px] pr-[10px] py-[8px] border border-transparent items-center grow"
								href="#" tabindex="0">
								<span
									class="menu-bullet flex w-[6px] relative before:absolute before:top-0 before:size-[6px] before:rounded-full before:-translate-x-1/2 before:-translate-y-1/2 menu-item-active:before:bg-primary menu-item-hover:before:bg-primary">
								</span>
								<span class="menu-title text-2sm font-medium text-gray-700">
									Donators
								</span>
								<span class="menu-badge mr-[-10px]">
									<span class="badge badge-xs">
										Soon
									</span>
								</span>
							</div>
						</div>
					</div>
				</div>

				<div class="menu-item pt-2.25 pb-px">
					<span class="menu-heading uppercase pl-[10px] pr-[10px] text-2sm font-semibold text-gray-500">
						Konfigurasi
					</span>
				</div>
                <div class="menu-item">
					<a class="menu-link flex items-center grow cursor-pointer border border-transparent gap-[10px] pl-[10px] pr-[10px] py-[6px]" href="{{ route('company.index') }}">
						<span class="menu-icon items-start text-gray-500 dark:text-gray-400 w-[20px]">
							<i class="ki-filled ki-bank text-lg">
							</i>
						</span>
						<span class="menu-title text-sm font-semibold text-gray-700 menu-item-active:text-primary menu-link-hover:!text-primary">
							Perusahaan
						</span>
					</a>
				</div>
			</div>
		</div>
	</div>
</div>
