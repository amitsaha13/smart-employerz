<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="icon" href="./img/logo/favicon.ico" title="smartemployerz" sizes="32x32" />
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="author" content="smartemployerz" />

    <!-- Bootstrap 5.1.3  -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
    <!--  Font-Awesome 5.15.4 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <!-- Select2 4.0.4 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/css/select2.min.css" />
    <!-- intlTelInput 17.0.13 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/css/intlTelInput.css" />
    <!-- Custom CSS -->
    <link rel="stylesheet" href="./css/style.css" />

    <title>smartemployerz</title>
</head>

<body>
    <!-- Start Main Section -->
    <main>
        <div class="container-fluid custom-width">
            <div class="row">
                <!-- Sidebar -->
                <div class="col-lg-3 sidenav px-0 responsive-height" id="mySidenav">
                    <span class="closebtn" onclick="closeNav()">&times;</span>
                    <div class="sidebar-wrapper">
                        <div class="logo">
                            <a href="/">
                                <img src="./img/logo/logo.png" alt="Logo" class="img-fluid" width="189"
                                    height="38" />
                            </a>
                        </div>
                        <div class="company-name">
                            <img src="./img/dashboard/grameen.png" alt="company-logo" class="img-fluid" />
                            <div class="content">
                                <h3>Grameen Phone</h3>
                                <span>Bangladesh</span>
                            </div>
                        </div>
                        <ul class="list-unstyled ps-0">
                            <p>General</p>
                            <li class="active">
                                <a href="#">
                                    <svg width="32" height="32" viewBox="0 0 32 32" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M5 6C5 5.44772 5.44772 5 6 5H14C14.5523 5 15 5.44772 15 6V14C15 14.5523 14.5523 15 14 15H6C5.44772 15 5 14.5523 5 14V6ZM7 7V13H13V7H7Z"
                                            fill="white" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M17 6C17 5.44772 17.4477 5 18 5H26C26.5523 5 27 5.44772 27 6V14C27 14.5523 26.5523 15 26 15H18C17.4477 15 17 14.5523 17 14V6ZM19 7V13H25V7H19Z"
                                            fill="white" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M5 18C5 17.4477 5.44772 17 6 17H14C14.5523 17 15 17.4477 15 18V26C15 26.5523 14.5523 27 14 27H6C5.44772 27 5 26.5523 5 26V18ZM7 19V25H13V19H7Z"
                                            fill="white" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M17 18C17 17.4477 17.4477 17 18 17H26C26.5523 17 27 17.4477 27 18V26C27 26.5523 26.5523 27 26 27H18C17.4477 27 17 26.5523 17 26V18ZM19 19V25H25V19H19Z"
                                            fill="white" />
                                    </svg>
                                    <span>Dashboard</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <svg width="32" height="32" viewBox="0 0 32 32" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M12.1562 10H25.1562" stroke="white" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M12.1562 16H25.1562" stroke="white" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M12.1562 22H25.1562" stroke="white" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M7.15625 10H7.16625" stroke="white" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M7.15625 16H7.16625" stroke="white" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M7.15625 22H7.16625" stroke="white" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <span>Activity</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <svg width="32" height="32" viewBox="0 0 32 32" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M16 6.3125L6 11.3125L16 16.3125L26 11.3125L16 6.3125Z" stroke="white"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M6 21.3125L16 26.3125L26 21.3125" stroke="white" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M6 16.3125L16 21.3125L26 16.3125" stroke="white" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <span>Package Plan</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <svg width="32" height="32" viewBox="0 0 32 32" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M25 15.8125C25.0034 17.1324 24.6951 18.4344 24.1 19.6125C23.3944 21.0243 22.3098 22.2117 20.9674 23.0418C19.6251 23.8719 18.0782 24.3119 16.5 24.3125C15.1801 24.316 13.8781 24.0076 12.7 23.4125L7 25.3125L8.9 19.6125C8.30493 18.4344 7.99656 17.1324 8 15.8125C8.00061 14.2343 8.44061 12.6874 9.27072 11.3451C10.1008 10.0028 11.2883 8.9181 12.7 8.21253C13.8781 7.61746 15.1801 7.30909 16.5 7.31253H17C19.0843 7.42752 21.053 8.30729 22.5291 9.78339C24.0052 11.2595 24.885 13.2282 25 15.3125V15.8125Z"
                                            stroke="white" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                    <span>Messages</span> <span class="badge">2</span>
                                </a>
                            </li>

                            <!-- <li>
                  <button
                    class="btn-toggle collapsed"
                    data-bs-toggle="collapse"
                    data-bs-target="#account-collapse"
                    aria-expanded="false"
                  >
                  <svg
                  width="32"
                  height="32"
                  viewBox="0 0 32 32"
                  fill="none"
                  xmlns="http://www.w3.org/2000/svg"
                  class="btn-icon"
                >
                  <path
                    d="M20 21V19C20 17.9391 19.5786 16.9217 18.8284 16.1716C18.0783 15.4214 17.0609 15 16 15H8C6.93913 15 5.92172 15.4214 5.17157 16.1716C4.42143 16.9217 4 17.9391 4 19V21"
                    stroke="#BFC5C5"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                  />
                  <path
                    d="M12 11C14.2091 11 16 9.20914 16 7C16 4.79086 14.2091 3 12 3C9.79086 3 8 4.79086 8 7C8 9.20914 9.79086 11 12 11Z"
                    stroke="#BFC5C5"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                  />
                </svg> <span>Account</span>
                <svg class="dropdown-icon" width="10" height="5" viewBox="0 0 10 5" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M0.984835 0.234835C1.13128 0.0883883 1.36872 0.0883883 1.51517 0.234835L5 3.71967L8.48483 0.234835C8.63128 0.0883883 8.86872 0.0883883 9.01517 0.234835C9.16161 0.381282 9.16161 0.618718 9.01517 0.765165L5.26516 4.51516C5.11872 4.66161 4.88128 4.66161 4.73484 4.51516L0.984835 0.765165C0.838388 0.618718 0.838388 0.381282 0.984835 0.234835Z" fill="#9FA3AD"/>
                </svg>
                
                  </button>
                  <div class="collapse" id="account-collapse">
                    <ul
                      class="btn-toggle-nav mb-0"
                    >
                      <li class="mb-1">
                        <a href="#">
                          <svg
                      width="32"
                      height="32"
                      viewBox="0 0 32 32"
                      fill="none"
                      xmlns="http://www.w3.org/2000/svg"
                    >
                      <path
                        d="M12.1562 10H25.1562"
                        stroke="white"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                      />
                      <path
                        d="M12.1562 16H25.1562"
                        stroke="white"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                      />
                      <path
                        d="M12.1562 22H25.1562"
                        stroke="white"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                      />
                      <path
                        d="M7.15625 10H7.16625"
                        stroke="white"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                      />
                      <path
                        d="M7.15625 16H7.16625"
                        stroke="white"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                      />
                      <path
                        d="M7.15625 22H7.16625"
                        stroke="white"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                      />
                    </svg>
                          <span>Profile</span>
                        </a>
                      </li>
                      <li>
                        <a href="#">
                          <svg
                          width="32"
                          height="32"
                          viewBox="0 0 32 32"
                          fill="none"
                          xmlns="http://www.w3.org/2000/svg"
                        >
                          <g clip-path="url(#clip0_604_11834)">
                            <path
                              d="M16.4883 18.5039C18.1451 18.5039 19.4883 17.1608 19.4883 15.5039C19.4883 13.8471 18.1451 12.5039 16.4883 12.5039C14.8314 12.5039 13.4883 13.8471 13.4883 15.5039C13.4883 17.1608 14.8314 18.5039 16.4883 18.5039Z"
                              stroke="white"
                              stroke-width="2"
                              stroke-linecap="round"
                              stroke-linejoin="round"
                            />
                            <path
                              d="M23.8883 18.5039C23.7552 18.8055 23.7155 19.1401 23.7743 19.4645C23.8331 19.7889 23.9877 20.0882 24.2183 20.3239L24.2783 20.3839C24.4642 20.5697 24.6118 20.7902 24.7124 21.033C24.813 21.2758 24.8649 21.5361 24.8649 21.7989C24.8649 22.0617 24.813 22.322 24.7124 22.5648C24.6118 22.8076 24.4642 23.0282 24.2783 23.2139C24.0925 23.3999 23.872 23.5474 23.6292 23.648C23.3864 23.7487 23.1261 23.8005 22.8633 23.8005C22.6005 23.8005 22.3402 23.7487 22.0974 23.648C21.8546 23.5474 21.634 23.3999 21.4483 23.2139L21.3883 23.1539C21.1526 22.9234 20.8533 22.7687 20.5289 22.7099C20.2045 22.6511 19.8699 22.6908 19.5683 22.8239C19.2725 22.9507 19.0203 23.1612 18.8426 23.4294C18.6649 23.6977 18.5696 24.0121 18.5683 24.3339V24.5039C18.5683 25.0343 18.3576 25.543 17.9825 25.9181C17.6074 26.2932 17.0987 26.5039 16.5683 26.5039C16.0378 26.5039 15.5291 26.2932 15.1541 25.9181C14.779 25.543 14.5683 25.0343 14.5683 24.5039V24.4139C14.5605 24.0829 14.4534 23.7619 14.2608 23.4926C14.0682 23.2233 13.799 23.0182 13.4883 22.9039C13.1867 22.7708 12.8521 22.7311 12.5277 22.7899C12.2033 22.8487 11.904 23.0034 11.6683 23.2339L11.6083 23.2939C11.4225 23.4799 11.202 23.6274 10.9592 23.728C10.7164 23.8287 10.4561 23.8805 10.1933 23.8805C9.93045 23.8805 9.6702 23.8287 9.4274 23.728C9.1846 23.6274 8.96403 23.4799 8.77828 23.2939C8.59233 23.1082 8.44481 22.8876 8.34416 22.6448C8.24351 22.402 8.19171 22.1417 8.19171 21.8789C8.19171 21.6161 8.24351 21.3558 8.34416 21.113C8.44481 20.8702 8.59233 20.6497 8.77828 20.4639L8.83828 20.4039C9.06882 20.1682 9.22347 19.8689 9.28229 19.5445C9.3411 19.2201 9.3014 18.8855 9.16828 18.5839C9.04152 18.2881 8.83104 18.0359 8.56275 17.8582C8.29446 17.6805 7.98007 17.5852 7.65828 17.5839H7.48828C6.95785 17.5839 6.44914 17.3732 6.07407 16.9981C5.69899 16.623 5.48828 16.1143 5.48828 15.5839C5.48828 15.0535 5.69899 14.5448 6.07407 14.1697C6.44914 13.7946 6.95785 13.5839 7.48828 13.5839H7.57828C7.90928 13.5762 8.23029 13.469 8.49958 13.2764C8.76887 13.0838 8.974 12.8146 9.08828 12.5039C9.2214 12.2023 9.2611 11.8677 9.20229 11.5433C9.14347 11.2189 8.98882 10.9196 8.75828 10.6839L8.69828 10.6239C8.51233 10.4382 8.36481 10.2176 8.26416 9.97479C8.16351 9.73199 8.11171 9.47174 8.11171 9.20891C8.11171 8.94608 8.16351 8.68582 8.26416 8.44303C8.36481 8.20023 8.51233 7.97965 8.69828 7.79391C8.88403 7.60795 9.1046 7.46044 9.3474 7.35979C9.5902 7.25914 9.85045 7.20733 10.1133 7.20733C10.3761 7.20733 10.6364 7.25914 10.8792 7.35979C11.122 7.46044 11.3425 7.60795 11.5283 7.79391L11.5883 7.85391C11.824 8.08444 12.1233 8.23909 12.4477 8.29791C12.7721 8.35673 13.1067 8.31702 13.4083 8.18391H13.4883C13.7841 8.05714 14.0363 7.84666 14.214 7.57837C14.3916 7.31008 14.487 6.99569 14.4883 6.67391V6.50391C14.4883 5.97347 14.699 5.46477 15.0741 5.08969C15.4491 4.71462 15.9578 4.50391 16.4883 4.50391C17.0187 4.50391 17.5274 4.71462 17.9025 5.08969C18.2776 5.46477 18.4883 5.97347 18.4883 6.50391V6.59391C18.4896 6.91569 18.5849 7.23008 18.7626 7.49837C18.9403 7.76666 19.1925 7.97714 19.4883 8.10391C19.7899 8.23702 20.1245 8.27673 20.4489 8.21791C20.7733 8.15909 21.0726 8.00444 21.3083 7.77391L21.3683 7.71391C21.554 7.52795 21.7746 7.38044 22.0174 7.27979C22.2602 7.17914 22.5205 7.12733 22.7833 7.12733C23.0461 7.12733 23.3064 7.17914 23.5492 7.27979C23.792 7.38044 24.0125 7.52795 24.1983 7.71391C24.3842 7.89965 24.5318 8.12023 24.6324 8.36303C24.733 8.60582 24.7849 8.86608 24.7849 9.12891C24.7849 9.39174 24.733 9.65199 24.6324 9.89479C24.5318 10.1376 24.3842 10.3582 24.1983 10.5439L24.1383 10.6039C23.9077 10.8396 23.7531 11.1389 23.6943 11.4633C23.6355 11.7877 23.6752 12.1223 23.8083 12.4239V12.5039C23.935 12.7997 24.1455 13.0519 24.4138 13.2296C24.6821 13.4073 24.9965 13.5026 25.3183 13.5039H25.4883C26.0187 13.5039 26.5274 13.7146 26.9025 14.0897C27.2776 14.4648 27.4883 14.9735 27.4883 15.5039C27.4883 16.0343 27.2776 16.543 26.9025 16.9181C26.5274 17.2932 26.0187 17.5039 25.4883 17.5039H25.3983C25.0765 17.5052 24.7621 17.6005 24.4938 17.7782C24.2255 17.9559 24.015 18.2081 23.8883 18.5039Z"
                              stroke="white"
                              stroke-width="2"
                              stroke-linecap="round"
                              stroke-linejoin="round"
                            />
                          </g>
                          <defs>
                            <clipPath id="clip0_604_11834">
                              <rect
                                width="24"
                                height="24"
                                fill="white"
                                transform="translate(4.48828 3.50391)"
                              />
                            </clipPath>
                          </defs>
                        </svg>
                          <span>Settings</span>
                        </a>
                      </li>
                    </ul>
                  </div>
                </li> -->
                        </ul>
                        <ul class="list-unstyled ps-0 mb-0">
                            <p>Others</p>
                            <li>
                                <a href="#">
                                    <svg width="32" height="32" viewBox="0 0 32 32" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M27 10.3125L17.5 19.8125L12.5 14.8125L5 22.3125" stroke="white"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M21 10.3125H27V16.3125" stroke="white" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <span>Affiliate Program</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <svg width="32" height="32" viewBox="0 0 32 32" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M18 6.3125H10C9.46957 6.3125 8.96086 6.52321 8.58579 6.89829C8.21071 7.27336 8 7.78207 8 8.3125V24.3125C8 24.8429 8.21071 25.3516 8.58579 25.7267C8.96086 26.1018 9.46957 26.3125 10 26.3125H22C22.5304 26.3125 23.0391 26.1018 23.4142 25.7267C23.7893 25.3516 24 24.8429 24 24.3125V12.3125L18 6.3125Z"
                                            stroke="white" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path d="M18 6.3125V12.3125H24" stroke="white" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M20 17.3125H12" stroke="white" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M20 21.3125H12" stroke="white" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M14 13.3125H13H12" stroke="white" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <span>Job Template</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <svg width="32" height="32" viewBox="0 0 32 32" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M20 21V19C20 17.9391 19.5786 16.9217 18.8284 16.1716C18.0783 15.4214 17.0609 15 16 15H8C6.93913 15 5.92172 15.4214 5.17157 16.1716C4.42143 16.9217 4 17.9391 4 19V21"
                                            stroke="#BFC5C5" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path
                                            d="M12 11C14.2091 11 16 9.20914 16 7C16 4.79086 14.2091 3 12 3C9.79086 3 8 4.79086 8 7C8 9.20914 9.79086 11 12 11Z"
                                            stroke="#BFC5C5" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>

                                    <span>Candidate Pool</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <svg width="32" height="32" viewBox="0 0 32 32" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M22 24.3125V14.3125" stroke="white" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M16 24.3125V8.3125" stroke="white" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M10 24.3125V18.3125" stroke="white" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>

                                    <span>Analysis</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <svg width="32" height="32" viewBox="0 0 32 32" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(#clip0_604_11834)">
                                            <path
                                                d="M16.4883 18.5039C18.1451 18.5039 19.4883 17.1608 19.4883 15.5039C19.4883 13.8471 18.1451 12.5039 16.4883 12.5039C14.8314 12.5039 13.4883 13.8471 13.4883 15.5039C13.4883 17.1608 14.8314 18.5039 16.4883 18.5039Z"
                                                stroke="white" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                            <path
                                                d="M23.8883 18.5039C23.7552 18.8055 23.7155 19.1401 23.7743 19.4645C23.8331 19.7889 23.9877 20.0882 24.2183 20.3239L24.2783 20.3839C24.4642 20.5697 24.6118 20.7902 24.7124 21.033C24.813 21.2758 24.8649 21.5361 24.8649 21.7989C24.8649 22.0617 24.813 22.322 24.7124 22.5648C24.6118 22.8076 24.4642 23.0282 24.2783 23.2139C24.0925 23.3999 23.872 23.5474 23.6292 23.648C23.3864 23.7487 23.1261 23.8005 22.8633 23.8005C22.6005 23.8005 22.3402 23.7487 22.0974 23.648C21.8546 23.5474 21.634 23.3999 21.4483 23.2139L21.3883 23.1539C21.1526 22.9234 20.8533 22.7687 20.5289 22.7099C20.2045 22.6511 19.8699 22.6908 19.5683 22.8239C19.2725 22.9507 19.0203 23.1612 18.8426 23.4294C18.6649 23.6977 18.5696 24.0121 18.5683 24.3339V24.5039C18.5683 25.0343 18.3576 25.543 17.9825 25.9181C17.6074 26.2932 17.0987 26.5039 16.5683 26.5039C16.0378 26.5039 15.5291 26.2932 15.1541 25.9181C14.779 25.543 14.5683 25.0343 14.5683 24.5039V24.4139C14.5605 24.0829 14.4534 23.7619 14.2608 23.4926C14.0682 23.2233 13.799 23.0182 13.4883 22.9039C13.1867 22.7708 12.8521 22.7311 12.5277 22.7899C12.2033 22.8487 11.904 23.0034 11.6683 23.2339L11.6083 23.2939C11.4225 23.4799 11.202 23.6274 10.9592 23.728C10.7164 23.8287 10.4561 23.8805 10.1933 23.8805C9.93045 23.8805 9.6702 23.8287 9.4274 23.728C9.1846 23.6274 8.96403 23.4799 8.77828 23.2939C8.59233 23.1082 8.44481 22.8876 8.34416 22.6448C8.24351 22.402 8.19171 22.1417 8.19171 21.8789C8.19171 21.6161 8.24351 21.3558 8.34416 21.113C8.44481 20.8702 8.59233 20.6497 8.77828 20.4639L8.83828 20.4039C9.06882 20.1682 9.22347 19.8689 9.28229 19.5445C9.3411 19.2201 9.3014 18.8855 9.16828 18.5839C9.04152 18.2881 8.83104 18.0359 8.56275 17.8582C8.29446 17.6805 7.98007 17.5852 7.65828 17.5839H7.48828C6.95785 17.5839 6.44914 17.3732 6.07407 16.9981C5.69899 16.623 5.48828 16.1143 5.48828 15.5839C5.48828 15.0535 5.69899 14.5448 6.07407 14.1697C6.44914 13.7946 6.95785 13.5839 7.48828 13.5839H7.57828C7.90928 13.5762 8.23029 13.469 8.49958 13.2764C8.76887 13.0838 8.974 12.8146 9.08828 12.5039C9.2214 12.2023 9.2611 11.8677 9.20229 11.5433C9.14347 11.2189 8.98882 10.9196 8.75828 10.6839L8.69828 10.6239C8.51233 10.4382 8.36481 10.2176 8.26416 9.97479C8.16351 9.73199 8.11171 9.47174 8.11171 9.20891C8.11171 8.94608 8.16351 8.68582 8.26416 8.44303C8.36481 8.20023 8.51233 7.97965 8.69828 7.79391C8.88403 7.60795 9.1046 7.46044 9.3474 7.35979C9.5902 7.25914 9.85045 7.20733 10.1133 7.20733C10.3761 7.20733 10.6364 7.25914 10.8792 7.35979C11.122 7.46044 11.3425 7.60795 11.5283 7.79391L11.5883 7.85391C11.824 8.08444 12.1233 8.23909 12.4477 8.29791C12.7721 8.35673 13.1067 8.31702 13.4083 8.18391H13.4883C13.7841 8.05714 14.0363 7.84666 14.214 7.57837C14.3916 7.31008 14.487 6.99569 14.4883 6.67391V6.50391C14.4883 5.97347 14.699 5.46477 15.0741 5.08969C15.4491 4.71462 15.9578 4.50391 16.4883 4.50391C17.0187 4.50391 17.5274 4.71462 17.9025 5.08969C18.2776 5.46477 18.4883 5.97347 18.4883 6.50391V6.59391C18.4896 6.91569 18.5849 7.23008 18.7626 7.49837C18.9403 7.76666 19.1925 7.97714 19.4883 8.10391C19.7899 8.23702 20.1245 8.27673 20.4489 8.21791C20.7733 8.15909 21.0726 8.00444 21.3083 7.77391L21.3683 7.71391C21.554 7.52795 21.7746 7.38044 22.0174 7.27979C22.2602 7.17914 22.5205 7.12733 22.7833 7.12733C23.0461 7.12733 23.3064 7.17914 23.5492 7.27979C23.792 7.38044 24.0125 7.52795 24.1983 7.71391C24.3842 7.89965 24.5318 8.12023 24.6324 8.36303C24.733 8.60582 24.7849 8.86608 24.7849 9.12891C24.7849 9.39174 24.733 9.65199 24.6324 9.89479C24.5318 10.1376 24.3842 10.3582 24.1983 10.5439L24.1383 10.6039C23.9077 10.8396 23.7531 11.1389 23.6943 11.4633C23.6355 11.7877 23.6752 12.1223 23.8083 12.4239V12.5039C23.935 12.7997 24.1455 13.0519 24.4138 13.2296C24.6821 13.4073 24.9965 13.5026 25.3183 13.5039H25.4883C26.0187 13.5039 26.5274 13.7146 26.9025 14.0897C27.2776 14.4648 27.4883 14.9735 27.4883 15.5039C27.4883 16.0343 27.2776 16.543 26.9025 16.9181C26.5274 17.2932 26.0187 17.5039 25.4883 17.5039H25.3983C25.0765 17.5052 24.7621 17.6005 24.4938 17.7782C24.2255 17.9559 24.015 18.2081 23.8883 18.5039Z"
                                                stroke="white" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_604_11834">
                                                <rect width="24" height="24" fill="white"
                                                    transform="translate(4.48828 3.50391)" />
                                            </clipPath>
                                        </defs>
                                    </svg>

                                    <span>Setting</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <svg width="32" height="32" viewBox="0 0 32 32" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M22.6228 10.8633C23.8812 12.1221 24.7381 13.7257 25.0851 15.4715C25.4321 17.2172 25.2537 19.0267 24.5725 20.671C23.8912 22.3154 22.7376 23.7208 21.2576 24.7096C19.7777 25.6984 18.0377 26.2262 16.2578 26.2262C14.4779 26.2262 12.738 25.6984 11.258 24.7096C9.77801 23.7208 8.62446 22.3154 7.94318 20.671C7.26191 19.0267 7.08351 17.2172 7.43053 15.4715C7.77756 13.7257 8.63444 12.1221 9.89282 10.8633"
                                            stroke="#BFC5C5" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path d="M16.2617 6.22266V16.2227" stroke="#BFC5C5" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <span>Logout</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Main Bar -->
                <div class="col-lg-9 main-wrapper px-0 responsive-height">
                    <span class="humburger" onclick="openNav()">&#9776;</span>
                    <div class="dashboard">
                        <div class="job-schedule">
                            <div class="card-body p-0">
                                <div class="top-header">
                                    <div class="brand-details">
                                        <div class="brand-logo">
                                            <img src="./img/brand.png" alt="Brand Logo" class="img-fluid" />
                                        </div>
                                        <div class="brand-info">
                                            <h1>Brand Manager</h1>
                                            <h2>Part Time</h2>
                                            <p>
                                                Lorem ipsum dolor sit amet consectetur. Nunc nec proin
                                                ut leo. Mauris ut eu non est blandit. Imperdiet urna
                                                eu at nullam quisque auctor justo nunc.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="details">
                                    <h3 class="mt-5 mb-4">Job Details :</h3>
                                    <section class="mb-4">
                                        <dl>
                                            <dt>Job Type :</dt>
                                            <dd>Part Time</dd>
                                        </dl>
                                        <dl>
                                            <dt>Experience :</dt>
                                            <dd>5-6 years</dd>
                                        </dl>
                                        <dl>
                                            <dt>Location :</dt>
                                            <dd>Dhaka, Bangladesh</dd>
                                        </dl>
                                    </section>
                                    <section class="mb-4">
                                        <h4>Description :</h4>
                                        <p>
                                            WellDev is looking for a Senior UI & UX Designer who
                                            will be responsible for leading different projects for
                                            designing interactive and user friendly interfaces for
                                            state of the art products of our clients. If you are
                                            eager to design world class user experience for the
                                            global market, we’d like to meet you. Ultimately, you
                                            will be creating both functional and appealing features
                                            that address our clients’ needs and help us grow our
                                            customer base.
                                        </p>
                                    </section>
                                    <section class="mb-4">
                                        <dl>
                                            <dt>Salary :</dt>
                                            <dd>8,000 Taka - 12,000 Taka</dd>
                                        </dl>
                                    </section>
                                    <section class="mb-4">
                                        <h4>Job Requirements & Skills :</h4>
                                        <ul class="job-skills">
                                            <li>Minimum of 30 hours per week</li>
                                            <li>
                                                Previous experience as a Chef De Partie/Demi Chef in a
                                                busy a la carte operation
                                            </li>
                                            <li>
                                                Flexible to work rostered shifts, including weekends,
                                                late nights and public holidays.
                                            </li>
                                            <li>Minimum of 30 hours per week</li>
                                            <li>
                                                Previous experience as a Chef De Partie/Demi Chef in a
                                                busy a la carte operation
                                            </li>
                                            <li>
                                                Flexible to work rostered shifts, including weekends,
                                                late nights and public holidays.
                                            </li>
                                        </ul>
                                    </section>
                                    <section class="mb-4">
                                        <dl>
                                            <dt>Educational Requirements :</dt>
                                            <dd>NA</dd>
                                        </dl>
                                    </section>
                                    <section class="mb-4">
                                        <dl>
                                            <dt>Training & Certifications :</dt>
                                            <dd>NA</dd>
                                        </dl>
                                    </section>
                                    <section class="mb-4">
                                        <h4>Compensation & Benefits :</h4>
                                        <ul>
                                            <li>
                                                Discounts at our hotels, restaurants and spas across
                                                our network
                                            </li>
                                            <li>Staff, family and friends rates at our hotels</li>
                                            <li>
                                                Meals on duty, staff parking and uniform provided
                                            </li>
                                            <li>Minimum of 30 hours per week</li>
                                            <li>Excellent reward & recognition events</li>
                                            <li>Service and anniversary gifts and benefits</li>
                                            <li>
                                                Wellbeing programme including Health insurance
                                                discounts
                                            </li>
                                            <li>
                                                Paid training and individual Employee Development
                                                Plans
                                            </li>
                                            <li>
                                                Training towards NZQA qualifications and our very own
                                                online digital learning platform
                                            </li>
                                            <li>
                                                Free Life Insurance, Digital Will & Best Doctors
                                                teleservice after 3 months of employment
                                            </li>
                                        </ul>
                                    </section>
                                    <section class="mb-4">
                                        <h4>Additional Information :</h4>
                                        <ul class="add-info">
                                            <li>Gender : Male</li>
                                            <li>Nationality : Bangladeshi</li>
                                            <li>Specialties : Na</li>
                                            <li>Industry : IT/ITES</li>
                                            <li>Age Range : 25 - 35</li>
                                            <li>Workplace : Work From Home</li>
                                        </ul>
                                    </section>
                                </div>
                                <div class="button-end">
                                    <!-- <button type="button" class="btn-default">
                      Ready To Publish
                    </button> -->
                                    <div class="row">
                                        <div class="col-xl-10">
                                            <div class="form-datePicker-wrapper">
                                                <button type="button" class="btn-default me-0">
                                                    Schedule For Later
                                                </button>
                                            </div>
                                        </div>
                                        <div class="col-xl-2">
                                            <button type="button" class="btn-form btn-form-continue me-0">
                                                Publish Now
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <footer>
                        <p>All Right Reserved by @smartemployerz.com</p>
                    </footer>
                </div>
            </div>
        </div>
    </main>
    <!-- End Main Section -->

    <!-- JQuery 3.7.1 -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <!-- Bootstrap 5.1.3 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <!-- Select2 4.0.4 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/js/select2.min.js"></script>
    <!-- intlTelInput 17.0.13 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/js/intlTelInput-jquery.min.js"></script>
    <!-- Custom JS -->
    <script src="./js/custom.js"></script>
</body>

</html>
