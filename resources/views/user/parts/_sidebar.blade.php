                    <div class="wrap-sidebar-account">
                        <div class="sidebar-account">
                            <div class="account-avatar">
                                <div class="image"><img alt="" loading="lazy" width="281" height="280" decoding="async"
                                        data-nimg="1" style="color:transparent" src="{{ Auth::user()->getImage() }}" />
                                </div>
                                <h6 class="mb_4">{{ Auth::user()->name }}</h6>
                                <div class="body-text-1">{{ Auth::user()->email }}</div>
                            </div>
                            <ul class="my-account-nav">
                                <li><a class="my-account-nav-item {{ (Request::segment(2) == 'profile') ? 'active' : ''  }}" href="{{ url('user/profile') }}"><svg width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M20 21V19C20 17.9391 19.5786 16.9217 18.8284 16.1716C18.0783 15.4214 17.0609 15 16 15H8C6.93913 15 5.92172 15.4214 5.17157 16.1716C4.42143 16.9217 4 17.9391 4 19V21"
                                                stroke="#181818" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round"></path>
                                            <path
                                                d="M12 11C14.2091 11 16 9.20914 16 7C16 4.79086 14.2091 3 12 3C9.79086 3 8 4.79086 8 7C8 9.20914 9.79086 11 12 11Z"
                                                stroke="#181818" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round"></path>
                                        </svg>Account Details</a></li>
                                <li><a class="my-account-nav-item {{ (Request::segment(2) == 'orders') ? 'active' : ''  }}" href="{{ url('user/orders') }}"><svg width="24"
                                            height="24" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M16.5078 10.8734V6.36686C16.5078 5.17166 16.033 4.02541 15.1879 3.18028C14.3428 2.33514 13.1965 1.86035 12.0013 1.86035C10.8061 1.86035 9.65985 2.33514 8.81472 3.18028C7.96958 4.02541 7.49479 5.17166 7.49479 6.36686V10.8734M4.11491 8.62012H19.8877L21.0143 22.1396H2.98828L4.11491 8.62012Z"
                                                stroke="#181818" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round"></path>
                                        </svg>Your Orders</a></li>

                                        <!-- <li><a class="my-account-nav-item {{ (Request::segment(2) == 'referral_orders') ? 'active' : ''  }}" href="{{ url('user/referral_orders') }}"><svg width="24"
                                            height="24" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M16.5078 10.8734V6.36686C16.5078 5.17166 16.033 4.02541 15.1879 3.18028C14.3428 2.33514 13.1965 1.86035 12.0013 1.86035C10.8061 1.86035 9.65985 2.33514 8.81472 3.18028C7.96958 4.02541 7.49479 5.17166 7.49479 6.36686V10.8734M4.11491 8.62012H19.8877L21.0143 22.1396H2.98828L4.11491 8.62012Z"
                                                stroke="#181818" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round"></path>
                                        </svg>Your Referral Order</a></li> -->

                                    <!-- <li>
                                    <a class="my-account-nav-item {{ (Request::segment(2) == 'wallet') ? 'active' : ''  }}" href="{{ url('user/wallet') }}">
                                        <svg width="24" height="24" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M18.3376 5.83315H19.1709V14.1665H18.3376V16.6665C18.3376 17.1267 17.9645 17.4998 17.5042 17.4998H2.50423C2.044 17.4998 1.6709 17.1267 1.6709 16.6665V3.33315C1.6709 2.87291 2.044 2.49982 2.50423 2.49982H17.5042C17.9645 2.49982 18.3376 2.87291 18.3376 3.33315V5.83315ZM16.6709 14.1665H11.6709C9.36975 14.1665 7.50423 12.301 7.50423 9.99982C7.50423 7.69862 9.36975 5.83315 11.6709 5.83315H16.6709V4.16648H3.33757V15.8332H16.6709V14.1665ZM17.5042 12.4998V7.49982H11.6709C10.2902 7.49982 9.17092 8.61907 9.17092 9.99982C9.17092 11.3805 10.2902 12.4998 11.6709 12.4998H17.5042ZM11.6709 9.16649H14.1709V10.8332H11.6709V9.16649Z"
                                                fill="black" />
                                        </svg>
                                        My Wallet
                                    </a>
                                    </li> -->
                                    <li>
                                    <a class="my-account-nav-item {{ (Request::segment(2) == 'change-password') ? 'active' : ''  }}" href="{{ url('user/change-password') }}">
                                        <svg width="24" height="24" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M18.3376 5.83315H19.1709V14.1665H18.3376V16.6665C18.3376 17.1267 17.9645 17.4998 17.5042 17.4998H2.50423C2.044 17.4998 1.6709 17.1267 1.6709 16.6665V3.33315C1.6709 2.87291 2.044 2.49982 2.50423 2.49982H17.5042C17.9645 2.49982 18.3376 2.87291 18.3376 3.33315V5.83315ZM16.6709 14.1665H11.6709C9.36975 14.1665 7.50423 12.301 7.50423 9.99982C7.50423 7.69862 9.36975 5.83315 11.6709 5.83315H16.6709V4.16648H3.33757V15.8332H16.6709V14.1665ZM17.5042 12.4998V7.49982H11.6709C10.2902 7.49982 9.17092 8.61907 9.17092 9.99982C9.17092 11.3805 10.2902 12.4998 11.6709 12.4998H17.5042ZM11.6709 9.16649H14.1709V10.8332H11.6709V9.16649Z"
                                                fill="black" />
                                        </svg>
                                      Change Password
                                    </a>
                                </li>
                                <!-- <li>
                                        <a class="my-account-nav-item {{ (Request::segment(2) == 'withdraw-history') ? 'active' : ''  }}" href="{{ url('user/withdraw-history') }}">
                                        <svg width="24" height="24" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M15.0042 5.83315H17.5042C17.9645 5.83315 18.3376 6.20624 18.3376 6.66648V16.6665C18.3376 17.1267 17.9645 17.4998 17.5042 17.4998H2.50423C2.044 17.4998 1.6709 17.1267 1.6709 16.6665V3.33315C1.6709 2.87291 2.044 2.49982 2.50423 2.49982H15.0042V5.83315ZM3.33757 7.49982V15.8332H16.6709V7.49982H3.33757ZM3.33757 4.16648V5.83315H13.3376V4.16648H3.33757ZM12.5042 10.8332H15.0042V12.4998H12.5042V10.8332Z"
                                                fill="black" />
                                        </svg>

                                        Withdraw History
                                    </a>
                                </li> -->
                                <!-- <li>
                                    <a class="my-account-nav-item {{ (Request::segment(2) == 'bank-detail') ? 'active' : ''  }}" href="{{ url('user/bank-detail') }}">
                                        <svg width="24" height="24" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M1.66699 16.6667H18.3337V18.3334H1.66699V16.6667ZM3.33366 10.0001H5.00032V15.8334H3.33366V10.0001ZM7.50032 10.0001H9.16699V15.8334H7.50032V10.0001ZM10.8337 10.0001H12.5003V15.8334H10.8337V10.0001ZM15.0003 10.0001H16.667V15.8334H15.0003V10.0001ZM1.66699 5.83341L10.0003 1.66675L18.3337 5.83341V9.16675H1.66699V5.83341ZM3.33366 6.86347V7.50008H16.667V6.86347L10.0003 3.53014L3.33366 6.86347ZM10.0003 6.66675C9.54007 6.66675 9.16699 6.29365 9.16699 5.83341C9.16699 5.37318 9.54007 5.00008 10.0003 5.00008C10.4606 5.00008 10.8337 5.37318 10.8337 5.83341C10.8337 6.29365 10.4606 6.66675 10.0003 6.66675Z"
                                                fill="black" />
                                        </svg>


                                        Bank Detail
                                    </a>
                                </li> -->
                      
                                <li><a class="my-account-nav-item" href="{{ url('logout') }}"><svg width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M9 21H5C4.46957 21 3.96086 20.7893 3.58579 20.4142C3.21071 20.0391 3 19.5304 3 19V5C3 4.46957 3.21071 3.96086 3.58579 3.58579C3.96086 3.21071 4.46957 3 5 3H9"
                                                stroke="#181818" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round"></path>
                                            <path d="M16 17L21 12L16 7" stroke="#181818" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M21 12H9" stroke="#181818" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round"></path>
                                        </svg>Logout</a></li>
                            </ul>
                        </div>
                    </div>